<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        return view('sale', ['sales' => $sales]);
    }

    public function postSale(Request $request)
    {
        // Validate and process data
        $data = $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required',
            'count' => 'required|numeric',
        ]);
        Sale::create($data);
        return redirect('/sales');
    }

    public function specificSale($id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            abort(404);
        }

        return view('specific_sale', ['sale' => $sale]);
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        return view('sales_edit', ['sale' => $sale]);
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);

        // Validate and update the sale data
        $validatedData = $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required',
            'count' => 'required|numeric',
        ]);

        $sale->update($validatedData);
        return redirect('/sales');
    }

    public function delete($id)
    {
        $sale = Sale::find($id);

        if ($sale) {
            $sale->delete();
            return redirect('/sales');
        } else {
            abort(404);
        }
    }
}
