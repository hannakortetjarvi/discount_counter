<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Sale;

class PriceController extends Controller
{
    public function priceForOne($id)
    {
        $jsonId = json_decode($id);
        $discounts = Discount::whereJsonContains('customer_ids', $jsonId);
        $sales = Sale::where('customer_id', $jsonId);
        $data = [
            'discounts' => $discounts,
            'sales' => $sales,
        ];
        return response()->json($data);
    }

    public function priceForAll()
    {
        $discounts = Discount::paginate();
        $sales = Sale::paginate();
        $data = [
            'discounts' => $discounts,
            'sales' => $sales,
        ];
        return response()->json($data);
    }
}
