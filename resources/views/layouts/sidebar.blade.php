<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-text mx-3">Pushpo Dhara<br><span style="font-size:10px">Properties Ltd.</span></div>
    </a>
    <hr class="sidebar-divider my-0">
    @can('commission-list')
        <li class="nav-item @if(request()->is('commission*')) active @endif">
            <a class="nav-link" href="{{route('commission.index')}}">
                <i class="fa fa-percent"></i>
                <span>Commission</span>
            </a>
        </li>
    @endcan
    
    @canany(['accountant-list', 'agent-list', 'customer-list', 'shareholder-list', 'investor-list'])
        <li class="nav-item">
            @php
                $is_req_user = isRequest(['user-detail*', 'employee*', 'investor*', 'customer*', 'agent*']);
            @endphp
            <a class="nav-link @if($is_req_user) collapsed @endif " href="#" data-toggle="collapse" data-target="#user"
                aria-expanded="{{$is_req_user}}" aria-controls="user">
                <i class="fa fa-users"></i>
                <span>User</span>
            </a>
            @php
                $users = ['accountant' => 'Accountant', 'shareholder' => 'Master Agent'];
            @endphp
            <div id="user" class="collapse @if($is_req_user) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @foreach ($users as $key => $user)
                        @can($key.'-list')
                            <a class="collapse-item @if(request()->is('user-detail*') && request()->get('user') == $key) active @endif" href="{{route('user-detail.index', ['user' => $key])}}">{{$user}}</a>
                        @endcan
                    @endforeach
                    @can('customer-list')
                        <a href="{{route('customer.index')}}" class="collapse-item @if(request()->is('customer*')) active @endif">Customer</a>
                    @endcan
                    @can('agent-list')
                        <a href="{{route('agent.index')}}" class="collapse-item @if(request()->is('agent*')) active @endif">Agent</a>
                    @endcan
                    @can('investor-list')
                        <a href="{{route('investor.index')}}" class="collapse-item @if(request()->is('investor*')) active @endif">Investor</a>
                    @endcan
                    <a href="{{route('employee.index')}}" class="collapse-item @if(request()->is('employee*')) active @endif">Stuff</a>
                </div>
                
            </div>
        </li>
    @endcanany

    @canany(['expense-list', 'expense-type-list'])
        <li class="nav-item">
            <a class="nav-link @if(request()->is('expense*')) collapsed @endif " href="#" data-toggle="collapse" data-target="#expense"
                aria-expanded="@if(request()->is('expense*')) true @else false @endif" aria-controls="expense">
                <i class="fas fa-money-bill"></i>
                <span>Expenditure</span>
            </a>
            <div id="expense" class="collapse @if(request()->is('expense*') || request()->is('pos/expense*')) show @endif" aria-labelledby="headingTwo" >
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('expense-type-list')
                        <a href="{{route('expense-item.index')}}" class="collapse-item  @if(request()->is('expense-item*')) active @endif">Type Setting</a>
                    @endcan
                    @can('expense-list')
                        <a href="{{route('expense.index')}}" class="collapse-item  @if(request()->is('pos/expense*')) active @endif">All Expenses</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcanany

    @canany(['payment-list', 'other-deposit-list'])
        <li class="nav-item">
            <a class="nav-link @if(request()->is('deposit*')) collapsed @endif " href="#" data-toggle="collapse" data-target="#deposit"
                aria-expanded="@if(request()->is('deposit*')) true @else false @endif" aria-controls="deposit">
                <i class="fa fa-credit-card"></i>
                <span>Deposit</span>
            </a>
            <div id="deposit" class="collapse @if(request()->is('deposit*')) show @endif" aria-labelledby="headingThree" >
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('payment-list')
                        <a href="{{route('deposit-payment.index')}}" class="collapse-item  @if(request()->is('deposit-payment*') ||  request()->is('deposit-old-payment*')) active @endif">Sale Payment</a>
                    @endcan
                    @can('other-deposit-list')
                        <a href="{{route('deposit-other.index')}}" class="collapse-item  @if(request()->is('deposit-other*')) active @endif">Other Deposit</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcanany
    @canany(['salary-list', 'salary-type-list'])
        <li class="nav-item">
            @php
                $is_salary_route = isRequest(['salary', 'type-salary']);
            @endphp
            <a class="nav-link @if($is_salary_route) collapsed @endif " href="#" data-toggle="collapse" data-target="#salary"
                aria-expanded="{{ $is_salary_route }}" aria-controls="salary">
                <i class="fa fa-gift" aria-hidden="true"></i>
                <span>Salary</span>
            </a>
            <div id="salary" class="collapse @if($is_salary_route) show @endif" aria-labelledby="headingFour" >
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('salary-type-list')
                        <a href="{{route('type-salary.index')}}" class="collapse-item  @if(request()->is('type-salary*')) active @endif">Salary Type</a>
                    @endcan
                    @can('salary-list')
                        <a href="{{route('salary.index')}}" class="collapse-item  @if(request()->is('salary*')) active @endif">Salary</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcanany

    @can('role-list')
        <li class="nav-item @if(request()->is('roles/*')) active @endif">
            <a class="nav-link" href="{{route('roles.index')}}">
                <i class="fa fa-user-secret" aria-hidden="true"></i>
                <span>Role</span>
            </a>
        </li>
    @endcan
    @can('sale-list')
        <li class="nav-item @if(request()->is('sale*')) active @endif">
            <a class="nav-link" href="{{route('sale.index')}}">
                <i class="fa fa-id-badge" aria-hidden="true"></i>
                <span>Sale</span>
            </a>
        </li>
    @endcan
    <li class="nav-item">
        <a class="nav-link @if(request()->is('bank*')) collapsed @endif " href="#" data-toggle="collapse" data-target="#bank"
            aria-expanded="@if(request()->is('bank*')) true @else false @endif" aria-controls="bank">
            <i class="fa fa-university" aria-hidden="true"></i>
            <span>Bank</span>
        </a>
        <div id="bank" class="collapse @if(request()->is('bank*')) show @endif" aria-labelledby="headingFour" >
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="{{route('bank-name.index')}}" class="collapse-item  @if(request()->is('bank-name*')) active @endif">Names</a>
                @can('bank-info-list')
                    <a href="{{route('bank-info.index')}}" class="collapse-item  @if(request()->is('bank-info*')) active @endif">Other Infos.</a>
                @endcan
            </div>
        </div>
    </li>
    @can('investment-list')
        <li class="nav-item @if(request()->is('investment*') || request()->is('pos/investment*')) active @endif">
            <a class="nav-link" href="{{route('investment.index')}}">
                <i class="fas fa-hand-holding-usd"></i>
                <span>Investment</span>
            </a>
        </li>
    @endcan
    @can('land-purchase-list')
        <li class="nav-item @if(request()->is('land-purchase*')) active @endif">
            <a class="nav-link" href="{{route('land-purchase.index')}}">
                <i class="fas fa-landmark"></i>
                <span>Land Purchase</span>
            </a>
        </li>
    @endcan
    
    @can('withdraw-list')
        <li class="nav-item">
            <a class="nav-link @if(isRequest(['withdraw*', 'investment-withdraw*'])) collapsed @endif " href="#" data-toggle="collapse" data-target="#withdraw"
                aria-expanded="@if(isRequest(['withdraw*', 'investment-withdraw*'])) true @else false @endif" aria-controls="withdraw">
                <i class="fas fa-money-bill"></i>
                <span>Withdraw</span>
            </a>
            <div id="withdraw" class="collapse @if(isRequest(['withdraw*', 'investment-withdraw*'])) show @endif" aria-labelledby="headingTwo" >
                <div class="bg-white py-2 collapse-inner rounded">
                    <a href="{{route('investment-withdraw.index')}}" class="collapse-item  @if(request()->is('investment-withdraw*')) active @endif">Investors</a>
                    <a href="{{route('withdraw.index')}}" class="collapse-item  @if(request()->is('withdraw*')) active @endif">Other Users</a>
                </div>
            </div>
        </li>
    @endcan

    @can('report-list')
        <li class="nav-item @if(request()->is('report*')) active @endif">
            <a class="nav-link" href="{{route('report.index')}}">
                <i class="fa fa-chart-area"></i>
                <span>Report</span>
            </a>
        </li>
    @endcan
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>