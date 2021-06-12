<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VehicleController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.vehicles');
    }

    public function nextId()
    {
        return (new Vehicle)->getNextId();
    }


    public function nextIdwithVehicleCode($vid)
    {
        return [
            'id'=>(new Product)->getNextId(),
            'code'=>$this->find($vid)->code,
        ];;
    }


    public function enrollorupdate(Request $request)
    {

        if ($request->formconfig == 'update') {
            $request->validate([
                'vehicle_name' => ['required', 'string', 'min:2'],
                'vehicle_model_name' => ['required', 'string', 'min:2'],
                'formkey' => ['required', 'integer', 'exists:vehicles,id'],
            ]);

            $data = [
                'brand' => $request->vehicle_name,
                'model' => $request->vehicle_model_name,
                'code' => $this->genarateVehicleModelCode( $request->vehicle_name,$request->vehicle_model_name,$request->formkey),
            ];

            (new Vehicle)->edit($request->formkey, $data, ['view' => Session::get('view', 'non'), 'activity' => 'Updated']);

            return redirect()->back()->with(['code' => 1, 'color' => 'warning', 'msg' => 'Successfully Updated.']);
        } else {
            $request->validate([
                'vehicle_name' => ['required', 'string', 'min:2'],
                'vehicle_model_name' => ['required', 'string', 'min:2'],
            ]);

            $data = [
                'brand' => $request->vehicle_name,
                'model' => $request->vehicle_model_name,
                'code' => $this->genarateVehicleModelCode( $request->vehicle_name,$request->vehicle_model_name,$this->nextId()),
            ];

            (new Vehicle)->createVehicle($data, ['view' => Session::get('view', 'non'), 'activity' => 'Enroll']);

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Successfully Created.']);
        }
    }

    protected function genarateVehicleModelCode($str1,$str2,$id)
    {
        return strtoupper(substr($str1,0,2)).'/'.strtoupper(substr($str2,0,2)).'/'.str_pad($id, 3, "0", STR_PAD_LEFT);
    }

    public function editStatus($id, $status)
    {
        return (new Vehicle)->edit($id, ['status' => ($status == 2) ? 1 : 2], ['view' => Session::get('view', 'non'), 'activity' => 'Status Updated']);
    }

    public function find($id)
    {
        return (new Vehicle)->getData($id);
    }


    public function get()
    {

        $resp = [];

        $index = 1;

        foreach ((new Vehicle)->getVehicles(null) as $key => $value) {
            $resp[] = [$index, $value->code,
                $value->brand,
                $value->model,
                '<span class="badge bg-' . (($value->status == 1) ? 'green' : 'red') . '-100 text-' . (($value->status == 1) ? 'success' : 'danger') . ' px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle text-' . (($value->status == 1) ? 'teal' : 'danger') . ' fs-9px fa-fw me-5px"></i>' . (($value->status == 1) ? 'Active' : 'Inactive') . '</span>',
                '<div class="input-group flex-nowrap">
                <div class="m-1">
                    <button class="btn btn-secondary btn-sm" onclick="gvehicledata(' . $value->id . ')">
                        View / Edit
                    </button>
                </div>
                <div class="m-1">
                    <button style="width:80px" class="btn btn-round btn-outline-' . (($value->status == 1) ? 'danger' : 'success') . ' btn-sm" onclick="csvehicles(' . $value->id . ',' . $value->status . ')">
                        ' . (($value->status == 1) ? 'Deactive' : 'Active') . '
                    </button>
                </div>
                </div>'];
            $index++;
        }

        return $resp;
    }


    public function getData($id)
    {
        return $this->where('id',$id)->first();
    }

    public function suggetions(Request $request)
    {
        $data = array();

        foreach ((new Vehicle)->suggetions($request->all()) as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => $item->model.' ('.$item->brand.')',
            ];
        }

        return response()->json($data, 200);
    }
}
