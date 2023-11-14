<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Sale;

class PriceController extends Controller
{
    // Get One User's Discounts and Sales
    public function priceForOne($id)
    {
        $discounts = Discount::where('customer_ids', 'like', '%' . $id . '%')->get();
        $sales = Sale::where('customer_id', 'like', '%' . $id . '%')->get();

        $data = [
            'discounts' => $discounts,
            'sales' => $sales,
        ];

        return response()->json($data);
    }

    // Get Every Discount and Sale
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
