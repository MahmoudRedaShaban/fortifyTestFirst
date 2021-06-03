@csrf
<div class="form-group">
    <label for="description">Description</label>
    <input type="text" name="description" class="form-control" value="{{ old('description',$expense->description) }}">
    <span class="text-danger">{{ $errors->first('description') }}</span>
</div>
<div class="form-group">
    <label for="date">Date</label>
    <input type="date" name="date" class="form-control" value="{{ old('date',Carbon\Carbon::parse($expense->date)->format('Y-m-d')) }}">
    <span class="text-danger">{{ $errors->first('date') }}</span>
</div>
<div class="form-group">
    <label for="amount">Amount</label>
    <input type="text" name="amount" class="form-control" value="{{ old('amount',$expense->amount) }}">
    <span class="text-danger">{{ $errors->first('amount') }}</span>
</div>
<div class="form-group">
    <label for="category">Category</label>
        <select class="form-control" name="category">
            @foreach ($expenses as $exp)
                <option value="{{ $exp }}" {{ $expense->category == $exp ? 'selected':'' }}>{{ $exp }}</option>
            @endforeach
        </select>
    <span class="text-danger">{{ $errors->first('category') }}</span>
</div>
<div class="form-group">
    <label for="payment_method">Category</label>
        <select class="form-control" name="payment_method">
            @foreach ($methodPayment as $payment)
                <option value="{{ $payment }}" {{ $expense->payment_method == $payment ? 'selected':'' }} >{{ $payment }}</option>
            @endforeach
        </select>
    <span class="text-danger">{{ $errors->first('payment_method') }}</span>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary px-4">Save</button>
    <a href="{{ route('expenses.list') }}" type="button" class="btn btn-outline-info">Back</a>
</div>
