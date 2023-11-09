<!DOCTYPE html>
<html>
<head>
    <title>Edit Discount</title>
</head>
<body>
    <h1>Edit Discount</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('discounts.update', ['id' => $discount->id]) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="customer_id">Customer ID:</label>
            <input type="text" name="customer_id" value="{{ old('customer_id', $discount->customer_id) }}">
        </div>

        <div>
            <label for="product_id">Product ID:</label>
            <input type="text" name="product_id" value="{{ old('product_id', $discount->product_id) }}">
        </div>

        <div>
            <label for="amount">Amount:</label>
            <input type="text" name="amount" value="{{ old('amount', $discount->amount) }}">
        </div>

        <div>
            <label for="type">Type:</label>
            <input type="text" name="type" value="{{ old('type', $discount->type) }}">
        </div>

        <div>
            <label for="start_date">Start date:</label>
            <input type="date" name="start_date" value="{{ old('start_date', $discount->start_date) }}">
        </div>

        <div>
            <label for="end_date">End date:</label>
            <input type="date" name="end_date" value="{{ old('end_date', $discount->end_date) }}">
        </div>

        <div>
            <button type="submit">Update Discount</button>
        </div>
    </form>
</body>
</html>
