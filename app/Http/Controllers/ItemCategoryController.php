<?php

namespace App\Http\Controllers;

use App\Models\item_category;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    public function index()
    {

        $itemCode = 'ITMCAT/' . str_pad((new item_category)->getItemCount() + 1, 4, '0', STR_PAD_LEFT);

        $itemCategories = (new item_category)->getAll();
        return view('dashboard.item_category', compact('itemCategories', 'itemCode'));

    }

    public function store(Request $request)
    {

        $request->validate([
            'item_category_code' => 'required|min:9|max:11',
            'item_category_name' => 'required|min:3|max:255',
        ]);

        $item_category_count = item_category::where('item_category_code', $request->item_category_code)->first();

        if ($item_category_count) {

            (new item_category)->edit('item_category_code', $request->item_category_code, ['item_category_name' => $request->item_category_name]);

            return redirect()->back()->with(['code' => 1, 'color' => 'warning', 'msg' => 'Item Category Update Successful.']);

        } else {

            (new item_category)->add([
                'item_category_code' => $request->item_category_code,
                'item_category_name' => $request->item_category_name,
                'status' => 1,
            ]);

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Item Category Insert Successful.']);

        }

    }

    public function deactivate(Request $request)
    {

        $split = explode('-', $request->id, 3);
        $splitid = $split[2];

        $item_category = item_category::find($splitid);
        $item_category->status = 2;
        $item_category->save();

        return view('dashboard.components.item_category_list')->with('itemCategories', (new item_category)->getAll());

    }

    public function activate(Request $request)
    {

        $split = explode('-', $request->id, 3);
        $splitid = $split[2];

        $item_category = item_category::find($splitid);
        $item_category->status = 1;
        $item_category->save();

        return view('dashboard.components.item_category_list')->with('itemCategories', (new item_category)->getAll());

    }

}
