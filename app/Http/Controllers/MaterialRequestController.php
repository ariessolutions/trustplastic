<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\Job;
use App\Models\JobHasProduct;
use App\Models\material_request;
use App\Models\MRProductsHasItem;
use App\Models\Product;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MaterialRequestController extends Controller
{

    public function index()
    {

        $mr = (new material_request)->getAll();
        return view('dashboard.material_request', compact('mr'));
    }

    public function init(Request $request)
    {

        if (Session::has('job_id')) {
            if (Session::get('job_id') != $request->id) {

                $this->productItemSessionClear();
                if (Session::has('mr_job_id')) {
                    Session::forget('mr_job_id');
                }

                if (Session::has('mr_code')) {
                    Session::forget('mr_code');
                }

                Session::put('job_id', $request->id);
            }
        } else {
            Session::put('job_id', $request->id);
        }

        $mr_code = 'MR/' . date('smy') . '/' . str_pad((new material_request)->getMrCount() + 1, 3, '0', STR_PAD_LEFT);
        $job_id = $request->id;
        $job = Job::find($job_id);
        $job_products = (new material_request)->getProductsOfJobByJobId($job_id);

        $attributes = array();

        foreach ($job_products as $key => $attriburte) {

            $product = (new Product)->where('id', $attriburte->product)->first();
            $vehicle = (new Vehicle)->where('id', $product->vehicle)->first();
            $attributes[] = [
                "id" => $attriburte->id,
                "code" => $product->code,
                "name" => $product->name,
                "brand" => $vehicle->brand,
                "model" => $vehicle->model,
            ];

        }

        $init_data = ["mr_code" => $mr_code, "job_code" => $job->code, "products" => $attributes];

        Session::put('mr_code', $mr_code);
        Session::put('mr_job_id', $job->id);

        return $init_data;

    }

    public function loadItem(Request $request)
    {
        $data = array();

        foreach ((new item)->suggetions($request->all()) as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => '(' . $item->item_part_code . ')' . ' ' . $item->item_name,
            ];
        }

        return response()->json($data, 200);
    }

    public function loadProduct(Request $request)
    {

        return Product::find(JobHasProduct::find($request->id)->product);

    }

    public function sessionRecords()
    {
        return Session::get('mr_has_item', []);
    }

    public function itemSaveSession(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'item_id' => 'required',
            'qty' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $isNew = true;

        $records = $this->sessionRecords();

        foreach ($records as $key => $value) {

            if ($value[0] == $request->product_id && $value[1] == $request->item_id) {
                $records[$key][2] = $request->qty;
                $isNew = false;
                break;
            }
        }

        if ($isNew) {
            $records[] = [$request->product_id, $request->item_id, $request->qty];
        }

        Session::put('mr_has_item', $records);

        return $this->sessionRecords();

    }

    public function materialsTableView()
    {
        $records = $this->sessionRecords();
        $tableData = [];

        foreach ($records as $key => $value) {

            $itemData = (new item)->getItemById($value[1]);

            $tableData[] = [$key + 1, Product::find($value[0])->code, $itemData->item_part_code, $value[2] . ' ' . $itemData['munit']['symbol'],
                '<div class="input-group flex-nowrap">
                    <div class="m-1">
                        <button class="btn btn-round btn-default btn-sm" onclick="mr_removeItemInSession(' . $key . ')")">
                            Remove
                        </button>
                    </div>
                </div>'];
        }

        return $tableData;

    }

    public function removeItemFromSession(Request $request)
    {
        $index = $request->index;

        $records = $this->sessionRecords();

        if (count($records) > 0) {
            array_splice($records, $index, 1);
            Session::put('mr_has_item', $records);
            return 1;
        } else {
            return 2;
        }
    }

    public function saveMaterialRequest(Request $request)
    {

        if(!Session::has('mr_has_item')){
            return 3;
        }

        if (!$request->session()->has('mr_code')) {
            return 2;
        }

        $data = [
            'mr_code' => $request->session()->get('mr_code'),
            'job_id' => $request->session()->get('mr_job_id'),
            'date' => Carbon::now()->format('Y/m/d'),
            'status' => 3,
        ];

        $material_request = (new material_request)->add($data);
        (new Job)->edit($request->session()->get('mr_job_id'), ['status' => 4], ['view' => Session::get('view', 'non'), 'activity' => 'Add a Material Request / Job Changed']);

        $records = $this->sessionRecords();

        foreach ($records as $key => $value) {
            $mr_has_item_data = [
                'job_has_product_id' => $value[0],
                'material_request_id' => $material_request->id,
                'item_id' => $value[1],
                'qty' => $value[2],
                'status' => 1,
            ];

            (new MRProductsHasItem)->add($mr_has_item_data);
        }

        Session::forget('mr_code');
        Session::forget('mr_job_id');

        $this->productItemSessionClear();
        return 1;
    }

    public function productItemSessionClear()
    {
        if (Session::has('mr_has_item')) {
            Session::forget('mr_has_item');
        }
    }

    public function loadRequestedMaterial(Request $request)
    {
        return (new material_request)->getMaterialRequestById($request->mr_id)->first();
    }

    public function printRequestedMaterial(Request $request)
    {
        $data = (new material_request)->getMaterialRequestById($request->mr_id)->first();
        if($data){
            // return $data;
            return view('reports.material_request_report')->with('data',$data);
        }else{
            return 2;
        }
    }

}
