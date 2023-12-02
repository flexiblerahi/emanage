{{--  --}}
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" /> --}}
@include('layouts.style')
<link rel="stylesheet" href="{{url('css/datatables.min.css')}}" />
  
<div class="container mb-2">
    <div class="row">
        <div class="col">
            <a id="new-salary" class="btn btn-primary" href="{{route('salary.create')}}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> New Salary</a>
        </div>
    </div>
</div>
<table id="myTable" class="table">
    <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>
    </tbody>
</table>
@include('layouts.script')
<script src="{{url('js/datatables/datatables.min.js')}}"></script>

<script>
    let table = new DataTable('#myTable', {
        // options
    });
</script>
