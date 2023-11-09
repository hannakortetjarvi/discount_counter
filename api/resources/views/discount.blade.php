<!doctype html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Discounts</title>

        <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>
    </head>

    <body>

        <div class="mw6 center pa3 sans-serif">

            <h1 class="mb4">Discounts</h1>

            <p>Create a new discount</p>

            <form method = "POST" action= "/discounts">
                @csrf
                <div>
                    <input type="text" name="product_id" placeholder="Product id">
                </div>

                <div>
                    <input type="text" name="customer_id" placeholder="Customer id">
                </div>

                <div>
                    <input type="text" name="type" placeholder="Type of discount">
                </div>

                <div>
                    <input type="text" name="amount" placeholder="Discount amount">
                </div>

                <div>
                    <input type="date" name="start_date" placeholder="Start date">
                </div>

                <div>
                    <input type="date" name="end_date" placeholder="End date">
                </div>

                <div>
                    <button type = "submit"> Create Discount </button>
                </div>
            </form>

            @foreach ($discounts as $discount)

            <div class="pa2 mb3 striped--near-white">

                <header class="b mb2">{{ $discount->id }}</header>

                <div class="pl2">

                    <p class="mb2">Customer id: {{ $discount->customer_id }}</p>
                    <p class="mb2">Product id: {{ $discount->product_id }}</p>
                    <p class="mb2">amount: {{ $discount->amount }}</p>
                    <p class="mb2">type: {{ $discount->type }}</p>
                    <p class="mb2">start: {{ $discount->start_date }}</p>
                    <p class="mb2">end: {{ $discount->end_date }}</p>

                    <a href="{{ route('discounts.edit', ['id' => $discount->id]) }}" class="btn">Update</a>

                    <form method="POST" action="{{ route('discounts.delete', ['id' => $discount->id]) }}">
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
