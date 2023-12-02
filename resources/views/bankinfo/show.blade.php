<table class="table table-bordered">
    <tbody>
        <tr>
            <td scope="row" class="font-weight-bold">Name: </td>
            <td>{{$bankinfo->bankname->name}}</td>
        </tr>
        <tr>
            <td scope="row" class="font-weight-bold">Account Id: </td>
            <td>{{$bankinfo->account_id}}</td>
        </tr>
        <tr>
            <td scope="row" class="font-weight-bold">Total Amount: </td>
            <td>{{tk($bankinfo->amount)}}</td>
        </tr>
        <tr>
            <td scope="row" class="font-weight-bold">Details info: </td>
            <td>{{$bankinfo->address}}</td>
        </tr>
    </tbody>
</table>
@include('modules.editor', ['editor_title' => 'Entry By', 'entrier' => $bankinfo->entrier])