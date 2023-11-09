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
        </div>
    </body>
</html>
