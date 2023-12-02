
<input type="hidden" name="expense_item_id" value="{{$expenseItem->id}}">
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