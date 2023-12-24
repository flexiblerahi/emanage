<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col border-right">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Created At:
                    </div>
                    <div class="col">
                        {{$category->created}}
                    </div>
                </div>
            </div>
            <div class="col ">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Updated At:
                    </div>
                    <div class="col">
                        {{$category->updated}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    @include('modules.header', ['title' => $category->title ])
    <table class="table table-bordered">
        <tbody>
            @foreach ($category->other as $other)
                <tr>
                    <td scope="row">{{$other['heading']}}</td>
                    <td>{{$other['describe']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('modules.editor', ['entrier' => $category->entrier])
</div>