<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\item_category;
use App\Models\measure_unit;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {

        $itemCode = 'ITM/' . str_pad((new item)->getItemCount() + 1, 4, '0', STR_PAD_LEFT);

        $item = (new item)->getAll();
        $itemCategory = (new item_category)->getActiveAll();
        $itemMeasureUnit = (new measure_unit)->getActiveAll();

        return view('dashboard.item', compact('itemCode', 'itemCategory', 'itemMeasureUnit', 'item'));

    }

    public function store(Request $request)
    {

        $request->validate([
            'item_code' => 'required|min:4|max:10',
            'item_name' => 'required|min:3|max:255',
            'item_category_id' => 'required',
            'measure_unit_id' => 'required',
        ]);

        if (item::where('item_code', $request->item_code)->first()) {

            (new item)->edit('item_code', $request->item_code, [
                'item_name' => $request->item_name,
                'item_category_id' => $request->item_category_id,
                'measure_unit_id' => $request->measure_unit_id,
            ]);

            return redirect()->back()->with(['code' => 1, 'color' => 'warning', 'msg' => 'Item Update Successful.']);

        } else {

            (new item)->add([
                'item_code' => $request->item_code,
                'item_name' => $request->item_name,
                'item_category_id' => $request->item_category_id,
                'measure_unit_id' => $request->measure_unit_id,
                'status' => 1,
            ]);

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Item Category Insert Successful.']);

        }

    }

    public function deactivate(Request $request)
    {

        $split = explode('-', $request->id, 3);
        $splitid = $split[2];

        $item = item::find($splitid);
        $item->status = 2;
        $item->save();

        return view('dashboard.components.item_list')->with('item', (new item)->getAll());

    }

    public function activate(Request $request)
    {

        $split = explode('-', $request->id, 3);
        $splitid = $split[2];

        $item = item::find($splitid);
        $item->status = 1;
        $item->save();

        return view('dashboard.components.item_list')->with('item', (new item)->getAll());

    }

    public function getItemById($id)
    {
        return (new item)->getItemById($id);
    }

}
