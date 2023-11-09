<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            //
        ]);

        return redirect('/sales')->with('success', 'Sale applied successfully.');
    }
}
