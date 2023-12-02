<?php

namespace App\Http\Controllers;

use App\DataTables\InvestmentCommissionDataTable;
use App\DataTables\InvestorCommissionDataTable;
use App\Models\BankTransaction;
use App\Models\Investment;
use App\Models\InvestmentCommission;
use App\Models\Investor;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class InvestmentCommissionController extends Controller
{
    protected $carbon;

    public function __construct(Carbon $carbon)
    {
        $this->carbon = $carbon;
    }

    public function index() {
        $now = $this->carbon->now()->startOfMonth()->format('Y-m-d');
        $previousMonth = $this->carbon->now()->copy()->subMonth();
        $previousMonthDays = $previousMonth->daysInMonth;

        $investments = Investment::with('investor:id,income', 'bank_transaction:id,amount,model_type,model_id');
        $investments = $investments->where('status', 1)->whereDate('invest_at', '<', $now);
        $investments = $investments->where(function ($search) use ($now) {
            $search->whereNull('last_interest')->orWhere('last_interest', '!=', $now);
        });
        $investments = $investments->select(['id', 'investor_id', 'rate', 'status', 'invest_at', 'last_interest'])->get();
        if(count($investments) < 1) return redirect()->route('home')->with(['message' => 'No Investment is remaining for the interest.', 'alert-type' => 'success']);
        foreach ($investments as $investment) {
            $invest_date = $this->carbon->createFromFormat('Y-m-d', $investment->invest_at);
            $daysCount = $invest_date->diffInDays($now);
            // dd($daysCount);
            if($daysCount > $previousMonthDays) {
                DB::beginTransaction();
                try {
                    $commission = (int) $investment->bank_transaction->amount * ((int) $investment->rate / 100);
                    InvestmentCommission::store($investment, $commission);
                    $investment->investor->income = (double) $investment->investor->income + $commission;
                    $investment->investor->save();
                    $investment->last_interest = $now;
                    $investment->save();
                    DB::commit();
                } catch(Exception $e) {
                    DB::rollback();
                    dd('error:: '. $e);
                }
            } else if($daysCount > 0) {
                DB::beginTransaction();
                try {
                    $commission = (int) $investment->bank_transaction->amount * ((int) $investment->rate / 100);
                    $remainCommission = $commission * ($daysCount / $previousMonthDays);
                    // dd('commission = '.$investment->rate.'%', 'investment amount = '.$investment->bank_transaction->amount, 'commission = '.$commission,'previous days = '. $daysCount,$daysCount.' days commission = '. $remainingCom);
                    InvestmentCommission::store($investment, $remainCommission);
                    $investment->investor->income = (double) $investment->investor->income + $remainCommission;
                    $investment->investor->save();
                    $investment->last_interest = $now;
                    $investment->save();
                    DB::commit();
                } catch(Exception $e) {
                    DB::rollback();
                    dd('error:: ' . $e);
                }
            }
        }
        return redirect()->route('home')->with(['message' => 'Interest of Invest Done Successsfully.', 'alert-type' => 'success']);
    }

    public function schedule() {
        $consoleOutput = new ConsoleOutput();
        $now = $this->carbon->now()->startOfMonth()->format('Y-m-d');
        $previousMonth = $this->carbon->now()->copy()->subMonth();
        $previousMonthDays = $previousMonth->daysInMonth;

        $investments = Investment::with('investor:id,income', 'bank_transaction:id,amount,model_type,model_id');
        $investments = $investments->where('status', 1)->whereDate('invest_at', '<', $now);
        $investments = $investments->where(function ($search) use ($now) {
            $search->whereNull('last_interest')->orWhere('last_interest', '!=', $now);
        });
        $investments = $investments->select(['id', 'investor_id', 'rate', 'status', 'invest_at', 'last_interest'])->get();
        foreach ($investments as $investment) {
            $invest_date = $this->carbon->createFromFormat('Y-m-d', $investment->invest_at);
            $daysCount = $invest_date->diffInDays($now);
            if($daysCount > $previousMonthDays) {
                DB::beginTransaction();
                try {
                    $commission = (int) $investment->bank_transaction->amount * ((int) $investment->rate / 100);
                    InvestmentCommission::store($investment, $commission);
                    $investment->investor->income = (int) $investment->investor->income + $commission;
                    $investment->investor->save();
                    $investment->last_interest = $now;
                    $investment->save();
                    DB::commit();
                } catch(Exception $e) {
                    $consoleOutput->writeln(`error {$e}`);
                    DB::rollback();
                } finally {
                    $consoleOutput->writeln('The Job is done');
                }
            } else if($daysCount > 0) {
                DB::beginTransaction();
                try {
                    $commission = (int) $investment->bank_transaction->amount * ((int) $investment->rate / 100);
                    $remainCommission = $commission * ($daysCount / $previousMonthDays);
                    // dd('commission = '.$investment->rate.'%', 'investment amount = '.$investment->bank_transaction->amount, 'commission = '.$commission,'previous days = '. $daysCount,$daysCount.' days commission = '. $remainingCom);
                    InvestmentCommission::store($investment, $remainCommission);
                    $investment->investor->income = (int) $investment->investor->income + $remainCommission;
                    $investment->investor->save();
                    $investment->last_interest = $now;
                    $investment->save();
                    DB::commit();
                } catch(Exception $e) {
                    DB::rollback();
                    $consoleOutput->writeln('error ' . $e);
                } finally {
                    $consoleOutput->writeln('The Job is done');
                }
            }
        }
        $consoleOutput->writeln('The Scheduling is completed for '. $now);
    }

    public function investorBase(InvestorCommissionDataTable $investorCommissionDataTable, $id) {
        $data['page'] = 'index';
        $investor = Investor::select('name')->findorfail($id);
        $data['title'] = $investor->name.' Interest List';
        $investorCommissionDataTable->setId($id);
        if(auth()->user()->can('investment-view')) {
            $data['modal'] = 'modules.modal';
            $data['modal_title'] = 'Investment Detail';
            $data['modal_type'] = 'investment';
            $data['modalbodyClass'] = 'p-0';
            $investorCommissionDataTable->setModaltype($data['modal_type']);
        }
        return $investorCommissionDataTable->render('home', $data);
    }

    public function investmentBase(InvestmentCommissionDataTable $investmentCommissionDataTable, $id) { //view('investment.commissionDetails')
        $data['page'] = 'index';
        $data['title'] = 'Investment All Interest List';
        $data['investment'] = InvestmentCommission::with(['investor', 'investment', 'investment.bank_transaction.bank_info.bankname'])->where('investment_id', $id)->latest()->firstorfail();
        $data['modalForm'] = 'investment.commissionDetails';
        $investmentCommissionDataTable->setId($id);
        return $investmentCommissionDataTable->render('home', $data);
    }
}
