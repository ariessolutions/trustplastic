<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {

        $supplierCode = 'SUP/' . str_pad((new supplier)->getSupplierCount() + 1, 4, '0', STR_PAD_LEFT);
        $supplier = (new supplier)->getAll();

        return view('dashboard.supplier', compact('supplierCode', 'supplier'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'supplier_code' => 'required|min:4|max:10',
            'supplier_name' => 'required|min:4|max:255',
            'supplier_primary_tel' => 'required|min:10|max:14',
            'supplier_secondary_tel' => 'nullable|min:10|max:14',
        ]);

        if (supplier::where('supplier_code', $request->supplier_code)->first()) {

            (new supplier)->edit('supplier_code', $request->supplier_code, [
                'supplier_name' => $request->supplier_name,
                'supplier_primary_tel' => $request->supplier_primary_tel,
                'supplier_secondary_tel' => $request->supplier_secondary_tel,
                'supplier_address' => $request->supplier_address,
                'supplier_payment_details' =>$request->supplier_payment_details,
                'supplier_remark' => $request->supplier_remark
            ]);

            return redirect()->back()->with(['code' => 1, 'color' => 'warning', 'msg' => 'Supplier Update Successful.']);

        } else {

            (new supplier)->add([
                'supplier_code' => $request->supplier_code,
                'supplier_name' => $request->supplier_name,
                'supplier_primary_tel' => $request->supplier_primary_tel,
                'supplier_secondary_tel' => $request->supplier_secondary_tel,
                'supplier_address' => $request->supplier_address,
                'supplier_payment_details' => $request->supplier_payment_details,
                'supplier_remark' => $request->supplier_remark,
                'status' => 1,
            ]);

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Supplier Insert Successful.']);

        }

    }

    public function deactivate(Request $request)
    {

        $split = explode('-', $request->id, 3);
        $splitid = $split[2];

        (new supplier)->activeStatus($splitid, 2);

        return view('dashboard.components.supplier_list')->with('supplier', (new supplier)->getAll());

    }

    public function activate(Request $request)
    {

        $split = explode('-', $request->id, 3);
        $splitid = $split[2];

        (new supplier)->activeStatus($splitid, 1);

        return view('dashboard.components.supplier_list')->with('supplier', (new supplier)->getAll());

    }

}
