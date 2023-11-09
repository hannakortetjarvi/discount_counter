<!doctype html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sales</title>

        <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>
    </head>

    <body>
        <div class="mw6 center pa3 sans-serif">

            <h1 class="mb4">Sales</h1>

            <p>Create a new sale</p>

            <form method = "POST" action= "/sales">
                @csrf
                <div>
                    <input type="text" name="product_id" placeholder="Product id">
                </div>

                <div>
                    <input type="text" name="customer_id" placeholder="Customer id">
                </div>

                <div>
                    <input type="text" name="count" placeholder="Amount of product">
                </div>

                <div>
                    <button type = "submit"> Create Sale </button>
                </div>
            </form>

            @foreach ($sales as $sale)

            <div class="pa2 mb3 striped--near-white">

                <header class="b mb2">{{ $sale->id }}</header>

                <div class="pl2">

                    <p class="mb2">customer: {{ $sale->customer_id }}</p>
                    <p class="mb2">product: {{ $sale->product_id }}</p>
                    <p class="mb2">count: {{ $sale->count }}</p>

                    <a href="{{ route('sales.edit', ['id' => $sale->id]) }}" class="btn">Update</a>

                    <form method="POST" action="{{ route('sales.delete', ['id' => $sale->id]) }}">
                        @csrf
                        @method('DELETE')
                            <button type="submit">Delete</button>
                    </form>

                </div>
            </div>

            @endforeach

        </div>
    </body>
</html>
