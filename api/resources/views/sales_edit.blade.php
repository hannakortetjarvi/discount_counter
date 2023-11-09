<!DOCTYPE html>
<html>
<head>
    <title>Edit Sale</title>
</head>
<body>
    <h1>Edit Sale</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('sales.update', ['id' => $sale->id]) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="product_id">Product ID:</label>
            <input type="text" name="product_id" value="{{ old('product_id', $sale->product_id) }}">
        </div>

        <div>
            <label for="customer_id">Customer ID:</label>
            <input type="text" name="customer_id" value="{{ old('customer_id', $sale->customer_id) }}">
        </div>

        <div>
            <label for="count">Count:</label>
            <input type="text" name="count" value="{{ old('count', $sale->count) }}">
        </div>

        <div>
            <button type="submit">Update Sale</button>
        </div>
    </form>
</body>
</html>
