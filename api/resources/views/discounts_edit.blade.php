<!doctype html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Discount</title>

        <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>
    </head>

    <body>
        <div class="mw6 center pa3 sans-serif">

            <p>Update sale</p>

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
        </div>
    </body>
</html>
