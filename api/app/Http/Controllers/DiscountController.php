<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    // Get Every Discount
    public function index()
    {
        $discounts = Discount::orderBy('id')->get();
        return response()->json($discounts);
    }

    // Post Discount
    public function postDiscount(Request $request)
    {
        // Validate data
        $data = $request->validate([
            'type' => 'required|string',
            'product_ids' => 'required',
            'customer_ids' => 'required',
            'amount' => 'required|numeric|min:1|max:100',
            'sales' => 'nullable|numeric',
            'start_date' => 'nullable|date|required_if:type,==,season',
            'end_date' => 'nullable|date|after:start_date|required_if:type,==,season',
        ]);
        $discount = Discount::create($data);
        return response()->json($discount);
    }

    // Get One Discount
    public function specificDiscount($id)
    {
        $discount = Discount::find($id);

        if (! $discount) {
            abort(404);
        }

        return response()->json($discount);
    }

    // Update Discount
    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);
        // Validate data
        $validatedData = $request->validate([
            'product_ids' => 'required|string',
            'customer_ids' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'type' => 'required|string',
            'sales' => 'nullable|numeric',
            'start_date' => 'nullable|date|required_if:type,==,season',
            'end_date' => 'nullable|date|after:start_date|required_if:type,==,season',
        ]);

        $discount->update($validatedData);
        return response()->json($discount);
    }

    // Delete Discount
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
