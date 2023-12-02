
<div id="userdetails">
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="expense_item_id">Expense Category</label>
                <select class="form-control select2" name="expense_item_id" id="expense_item_id">
                    <option value="">Select option</option>
                    @foreach ($expenseItems as $expenseItem)
                        <option value="{{$expenseItem->id}}">{{$expenseItem->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row mb-2">
    <div class="col">
        <input type="text" value="" id="daterange" class="form-control" name="daterange" autocomplete="off" placeholder="Date Range" readonly/>
    </div>
</div>
<button type="submit" class="btn btn-primary">Generate Report</button>