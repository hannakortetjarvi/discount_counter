<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    // Get Every Sale
    public function index()
    {
        $sales = Sale::orderBy('id')->get();
        return response()->json($sales);
    }

    // Post Sale
    public function postSale(Request $request)
    {
        // Validate data
        $data = $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required',
            'count' => 'required|numeric',
        ]);
        $sale = Sale::create($data);
        return response()->json($sale);
    }

    // Get One Sale
    public function specificSale($id)
    {
        $sale = Sale::find($id);

        if (! $sale) {
            abort(404);
        }

        return response()->json($sale);
    }

    // Update Sale
    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);
        // Validate data
        $validatedData = $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required',
            'count' => 'required|numeric',
        ]);

        $sale->update($validatedData);
        return response()->json($sale);
    }

    // Delete Sale
    public function delete($id)
    {
        $sale = Sale::find($id);

        if ($sale) {
            $sale->delete();
            return response()->json(null);
        } else {
            abort(404);
        }
    }
}
