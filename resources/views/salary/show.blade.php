<div class="card">
  <div class="card-body">
    <div class="row">
        <div class="col border-right">
            <div class="row">
                <div class="col-4 font-weight-bold">
                    Created At:
                </div>
                <div class="col">
                    {{$salary->created}}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-4 font-weight-bold">
                    Updated At:
                </div>
                <div class="col">
                    {{$salary->updated}}
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
<div class="card">
  @include('modules.header', ['title' => 'User Details', 'type' => 'user_details'])
  <div class="card-body show" id="user_details">
    @include('salary.userInfo', ['user' => $salary->user])
  </div>
</div>
@include('modules.show_bank_transaction', ['bank_transaction' => $salary->bank_transaction])
@include('modules.editor', ['entrier' => $salary->entrier, 'title' => 'Edited by'])