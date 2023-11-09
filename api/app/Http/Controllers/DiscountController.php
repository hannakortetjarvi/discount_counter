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
            //
        ]);

        return redirect('/discounts')->with('success', 'Discount applied successfully.');
    }
}
