<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col border-right">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Created At:
                    </div>
                    <div class="col">
                        {{$expenseItem->created}}
                    </div>
                </div>
            </div>
            <div class="col ">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Updated At:
                    </div>
                    <div class="col">
                        {{$expenseItem->updated}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    @include('modules.header', ['title' => $expenseItem->title ])
    <table class="table table-bordered">
        <tbody>
            @foreach ($expenseItem->other as $other)
                <tr>
                    <td scope="row">{{$other['heading']}}</td>
                    <td>{{$other['describe']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('modules.editor', ['entrier' => $expenseItem->entrier])
</div>