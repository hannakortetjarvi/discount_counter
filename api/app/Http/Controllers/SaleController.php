<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::paginate();
        return json_encode($sales);
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
        return json_encode($sale);
    }

    public function specificSale($id)
    {
        $sale = Sale::find($id);

        if (! $sale) {
            abort(404);
        }

        return json_encode($sale);
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
        return json_encode($sale);
    }

    public function delete($id)
    {
        $sale = Sale::find($id);

        if ($sale) {
            $sale->delete();
            return json_encode(null);
        } else {
            abort(404);
        }
    }
}
