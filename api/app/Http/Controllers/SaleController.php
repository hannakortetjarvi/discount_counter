<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        return response()->json($sales);
    }

    public function postSale(Request $request)
    {
        // Validate and process data
        $data = $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required',
            'count' => 'required|numeric',
        ]);
        $sale = Sale::create($data);
        return response()->json($sale);
    }

    public function specificSale($id)
    {
        $sale = Sale::find($id);

        if (! $sale) {
            abort(404);
        }

        return response()->json($sale);
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $validatedData = $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required',
            'count' => 'required|numeric',
        ]);

        $sale->update($validatedData);
        return response()->json($sale);
    }

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
