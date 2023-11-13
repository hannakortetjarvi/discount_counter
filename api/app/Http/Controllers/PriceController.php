<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Sale;

class PriceController extends Controller
{
    public function priceForOne($id)
    {
        $discounts = Discount::where('customer_ids', 'like', '%' . $id . '%')->get();
        $sales = Sale::where('customer_id', $id)->get();

        $data = [
            'discounts' => $discounts,
            'sales' => $sales,
        ];

        return response()->json($data);
    }

    public function priceForAll()
    {
        $discounts = Discount::all();
        $sales = Sale::all();
        $data = [
            'discounts' => $discounts,
            'sales' => $sales,
        ];

        return response()->json($data);
    }
}
