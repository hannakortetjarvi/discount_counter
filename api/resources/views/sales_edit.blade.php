<!doctype html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sale</title>

        <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>
    </head>

    <body>
        <div class="mw6 center pa3 sans-serif">

            <p>Update sale</p>

            <form method="POST" action="{{ route('sales.update', ['id' => $sale->id]) }}">
                @csrf
                @method('PUT')

                <div>
                    <label for="customer_id">Customer ID:</label>
                    <input type="text" name="customer_id" value="{{ old('customer_id', $sale->customer_id) }}">
                </div>

                <div>
                    <label for="product_id">Product ID:</label>
                    <input type="text" name="product_id" value="{{ old('product_id', $sale->product_id) }}">
                </div>

                <div>
                    <label for="count">Count:</label>
                    <input type="text" name="count" value="{{ old('count', $sale->count) }}">
                </div>

                <div>
                    <button type = "submit"> Update Sale </button>
                </div>
            </form>
        </div>
    </body>
</html>
