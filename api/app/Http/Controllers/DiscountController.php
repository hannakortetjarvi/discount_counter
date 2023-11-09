<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('discount', ['discounts' => $discounts]);
    }

    public function postDiscount(Request $request)
    {
        // Validate and process data
        $data = $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required',
            'amount' => 'required|numeric',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
        ]);

        return redirect('/discounts')->with('success', 'Discount applied successfully.');
    }
}
