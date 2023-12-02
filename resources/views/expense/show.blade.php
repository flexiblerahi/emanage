<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col border-right">
                <div class="row">
                    <div class="col-4 font-weight-bold">Created At:</div>
                    <div class="col">{{ $expense->created }}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Updated At:</div>
                    <div class="col">{{ $expense->updated }}</div>
                </div>
            </div>
        </div>
        @if(!is_null($expense->document))
            <div class="row mt-3">
                <div class="col">
                    <div class="row">
                        <div class="col-2 font-weight-bold">Document:</div>
                        <div class="col">
                            <a href="{{url($expense->document)}}" target="_blank" rel="paid document"><i class="fa fa-file" aria-hidden="true"></i> Pay Proof document</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@if (!is_null($expense->type->parents) )
    <div class="card">
        @include('modules.header', ['title' => 'Expense type titles: ', 'type' => 'expenseInfo'])   
        <div class="card-body show" id="expenseInfo">
            <h5>{{ $expense->type->title.'->'.$parentTitles }}</h5>
        </div>
    </div>
@else
    <div class="card">
        @include('modules.header', ['title' => 'Expense type title: ', 'type' => 'expenseInfo'])   
        <div class="card-body show" id="expenseInfo">
            <h5>{{ $expense->type->title }}</h5>
        </div>
    </div>
@endif
@include('modules.show_bank_transaction', ['bank_transaction' => $expense->bank_transaction])
@include('modules.editor', ['entrier' => $expense->entrier, 'title' => 'Edited by'])