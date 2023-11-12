<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Sale;

class PriceController extends Controller
{
    public function priceForOne($id)
    {
        $discounts = Discount::whereJsonContains('customer_ids', $id);
        $sales = Sale::where('customer_id', $id);
        $data = [
            'discounts' => $discounts,
            'sales' => $sales,
        ];
        return json_encode($data);
    }

    public function priceForAll($ids)
    {
        $discounts = Discount::paginate;
        $sales = Sale::paginate;
        $data = [
            'discounts' => $discounts,
            'sales' => $sales,
        ];
        return json_encode($data);
    }
}
