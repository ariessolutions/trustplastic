<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function index()
    {
        return view('dashboard.pages.products');
    }

    public function nextId()
    {
        return (new Product)->getNextId();
    }

    public function suggetions(Request $request)
    {
        $data = array();

        foreach ((new Vehicle)->suggetions($request->all()) as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => '(' . $item->code . ')' . ' - ' . $item->brand . '-' . $item->model,
            ];
        }

        return response()->json($data, 200);
    }

    public function suggetionsVehicle($vid, Request $request)
    {
        $data = array();

        foreach ((new Product)->suggetions($vid, $request->all()) as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => '(' . $item->code . ')' . ' - ' . $item->name,
            ];
        }

        return response()->json($data, 200);
    }

    public function enrollorupdate(Request $request)
    {

        if ($request->formconfig == 'update') {
            $request->validate([
                'vehicle_code' => ['required', 'integer', 'min:1', 'exists:vehicles,id'],
                'product_name' => ['required', 'string', 'min:2'],
                'formkey' => ['required', 'integer', 'exists:products,id'],
            ]);

            $data = [
                'vehicle' => $request->vehicle_code,
                'name' => $request->product_name,
                'code' => $this->generateCode((new Vehicle)->getData($request->vehicle_code)->code, $request->product_name, $request->formkey),
            ];

            (new Product)->edit($request->formkey, $data, ['view' => Session::get('view', 'non'), 'activity' => 'Updated']);

            return redirect()->back()->with(['code' => 1, 'color' => 'warning', 'msg' => 'Successfully Updated.']);
        } else {
            $request->validate([
                'vehicle_code' => ['required', 'integer', 'min:1', 'exists:vehicles,id'],
                'product_name' => ['required', 'string', 'min:2'],
            ]);

            $data = [
                'vehicle' => $request->vehicle_code,
                'name' => $request->product_name,
                'code' => $this->generateCode((new Vehicle)->getData($request->vehicle_code)->code, $request->product_name, $this->nextId()),
            ];

            (new Product)->createProduct($data, ['view' => Session::get('view', 'non'), 'activity' => 'Enroll']);

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Successfully Created.']);
        }
    }

    protected function generateCode($str1, $str2, $id)
    {
        return strtoupper($str1) . '/' . strtoupper(substr(str_replace(' ','',str_replace('-','',$str2)), 0, 2)) . '/' . str_pad($id, 3, "0", STR_PAD_LEFT);
    }

    public function editStatus($id, $status)
    {
        return (new Product)->edit($id, ['status' => ($status == 2) ? 1 : 2], ['view' => Session::get('view', 'non'), 'activity' => 'Status Updated']);
    }

    public function find($id)
    {   $data=(new Product)->getData($id);
        $vData=(new Vehicle)->find($data->vehicle);
        $data['sugg']='(' . $vData->code . ')' . ' - ' . $vData->brand . '-' . $vData->model;
        return $data;
    }

    public function get()
    {

        $resp = [];

        $index = 1;

        foreach ((new Product)->getAll(null) as $key => $value) {
            $resp[] = [$index, $value->code,
                $value->name,
                $value->vehicles->brand,
                '<span class="badge bg-' . (($value->status == 1) ? 'green' : 'red') . '-100 text-' . (($value->status == 1) ? 'success' : 'danger') . ' px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle text-' . (($value->status == 1) ? 'teal' : 'danger') . ' fs-9px fa-fw me-5px"></i>' . (($value->status == 1) ? 'Active' : 'Inactive') . '</span>',
                '<div class="input-group flex-nowrap">
                <div class="m-1">
                    <button class="btn btn-secondary btn-sm" onclick="gproductdata(' . $value->id . ')">
                       View / Edit
                    </button>
                </div>
                <div class="m-1">
                    <button style="width:80px" class="btn btn-round btn-outline-' . (($value->status == 1) ? 'danger' : 'success') . ' btn-sm" onclick="csproducts(' . $value->id . ',' . $value->status . ')">
                        ' . (($value->status == 1) ? 'Deactive' : 'Active') . '
                    </button>
                </div>
                </div>', ];
            $index++;
        }

        return $resp;
    }

}
