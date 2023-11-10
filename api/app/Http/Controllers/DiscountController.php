<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::paginate();
        return response()->json($discounts);
    }

    public function postDiscount(Request $request)
    {
        // Validate and process data
        $data = $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required',
            'amount' => 'required|numeric',
            'type' => 'string',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
        ]);
        $discount = Discount::create($data);
        return response()->json($discount);
    }

    public function specificDiscount($id)
    {
        $discount = Discount::find($id);

        if (! $discount) {
            abort(404);
        }

        return response()->json($discount);
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);
        $validatedData = $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required',
            'amount' => 'required|numeric',
            'type' => 'string',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
        ]);

        $discount->update($validatedData);
        return response()->json($discount);
    }

    public function delete($id)
    {
        $discount = Discount::find($id);

        if ($discount) {
            $discount->delete();
            return response()->json(null);
        } else {
            abort(404);
        }
    }
}
