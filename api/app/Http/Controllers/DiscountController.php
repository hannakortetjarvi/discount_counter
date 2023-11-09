<?php

namespace App\Http\Controllers;

use App\Models\Discount;
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
            'type' => 'string',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
        ]);
        Discount::create($data);
        return redirect('/discounts');
    }

    public function specificDiscount($id)
    {
        $discount = Discount::find($id);

        if (! $discount) {
            abort(404);
        }

        return view('specific_discount', ['discount' => $discount]);
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        return view('discounts_edit', ['discount' => $discount]);
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

        return redirect('/discounts');
    }

    public function delete($id)
    {
        $discount = Discount::find($id);

        if ($discount) {
            $discount->delete();
            return redirect('/discounts');
        } else {
            abort(404);
        }
    }
}
