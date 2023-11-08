<!doctype html>

<html>

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">



        <title>Users</title>

        <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>

    </head>

    <body>

        <div class="mw6 center pa3 sans-serif">

            <h1 class="mb4">Discounts</h1>



            @foreach($discounts as $discount)

            <div class="pa2 mb3 striped--near-white">

                <header class="b mb2">{{ $discount->customer_id }}</header>

                <div class="pl2">

                    <p class="mb2">id: {{ $discount->id }}</p>

                    <p class="mb2">amount: {{ $discount->amount }}</p>

                    <p class="mb2">type: {{ $discount->type }}</p>

                </div>

            </div>

            @endforeach

        </div>

    </body>

</html>