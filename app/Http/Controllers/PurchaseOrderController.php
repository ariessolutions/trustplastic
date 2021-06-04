<?php

namespace App\Http\Controllers;

use App\Models\bin_location;
use App\Models\item;
use App\Models\location;
use App\Models\po_has_items;
use App\Models\purchase_order;
use App\Models\supplier;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PurchaseOrderController extends Controller
{

    public function index(Request $request)
    {

        $isReferesh = true;

        $poCode = 'PO/' . date('smy') . '/' . str_pad((new purchase_order)->getPoCount() + 1, 3, '0', STR_PAD_LEFT);
        $location = (new Location)->getActiveAll();
        $purchase_orders = (new purchase_order)->getAll();

        $this->sessionPOClear($request);
        return view('dashboard.purchase_order_requests', compact('poCode', 'location', 'purchase_orders'));

    }

    public function sessionPOClear(Request $request)
    {

        if ($request->session()->has('pod')) {
            $request->session()->forget('pod');
        }
        if ($request->session()->has('subtotal')) {
            $request->session()->forget('subtotal');
        }

    }

    public function calculateSubTotals($records)
    {
        $total = 0;
        foreach ($records as $key => $value) {
            $total += $value[6];
        }
        return round($total, 2);
    }

    public function loadSupplier(Request $request)
    {

        $input = $request->all();

        $supplier_list = supplier::Where([
            ['status', '=', 1],
            ["supplier_code", "LIKE", "%{$input['query']}%"],
        ])
            ->orWhere([
                ['status', '=', 1],
                ["supplier_name", "LIKE", "%{$input['query']}%"],
            ])
            ->get();

        $data = array();
        foreach ($supplier_list as $supplier) {
            $data[] = $supplier->supplier_code . '-' . $supplier->supplier_name;
        }

        return response()->json($data);
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

    public function loadBinLocation(Request $request)
    {
        $input = $request->all();

        $bin_location_list = bin_location::Where([
            ['status', '=', 1],
            ['item_id', '=', $input['item_id']],
            ["location_id", "=", $input['location_id']],
        ])->get();

        $data = array();

        foreach ($bin_location_list as $bin_location) {
            $data[] = [
                'id' => $bin_location->id,
                'name' => $bin_location->bin_location_name,
            ];

        }

        return response()->json($data);
    }

    public function sessionRecords()
    {
        return Session::get('pod', []);
    }

    public function tableView()
    {

        $records = $this->sessionRecords();
        $tableData = [];

        foreach ($records as $key => $item) {
            $tableData[] = [$item[7]->item_part_code . '-' . $item[7]->item_name, $item[1]->bin_location_name, $item[2], $item[3], $item[4], $item[5], 'LKR ' . number_format($item[6], 2, '.', ','), '
            <div class="input-group flex-nowrap">
                    <div class="m-1">
                        <button id="editbtn' . $key . '" class="btn btn-secondary btn-sm" ia' . $key . '="' . ($item[7]['item_part_code'] . ' - ' . $item[7]['item_name']) . '" iaid' . $key . '="' . $item[7]['id'] . '" ib' . $key . '="' . $item[1]['id'] . '" ic' . $key . '="' . $item[2] . '" id' . $key . '="' . $item[3] . '" ie' . $key . '="' . $item[4] . '"if' . $key . '="' . $item[5] . '"
                            onclick="editPOItem(' . $key . ')">
                            View / Edit</button>
                    </div>
                    <div class="m-1">
                        <button class="btn btn-round btn-default btn-sm"
                            onclick="removePOItem(' . $key . ')">Remove
                        </button>
                    </div>
                </div>'];
        }

        return $tableData;
    }

    public function sessionPOItemCheck(Request $request)
    {
        if (!$request->session()->has('pod')) {
            return 2;
        } else {

            $isNew = true;

            foreach ($this->sessionRecords() as $key => $value) {

                if ($value[0] == $request->item_code) {
                    $isNew = false;
                    break;
                }
            }

            if ($isNew == false) {
                return 1;
            } else if ($isNew == true) {
                return 2;
            }

        }
    }

    public function sessionAdd(Request $request)
    {

        $nullCheck = false;

        $ic = $request->ic;
        $bid = $request->bid;
        $up = $request->up;
        $qty = $request->qty;
        $dis = $request->dis;
        $vat = $request->vat;

        if (($ic != '') && ($bid != '') && ($up != '') && ($qty != '') && ($up > 0) && ($qty > 0) && ($dis >= 0) && ($vat >= 0)) {

            if ($dis == '') {
                $dis = 0;
            }

            if ($vat == '') {
                $vat = 0;
            }

            $nullCheck = true;
        }

        $item = (new Item)->getItemById($ic);
        $bin_location = (new bin_location)->getBinLocationById($bid);

        if ($nullCheck && $item) {
            $records = $this->sessionRecords();

            $isNew = true;

            foreach ($records as $key => $value) {
                if ($value[0] == $ic) {
                    $records[$key][1] = $bin_location;
                    $records[$key][2] = $up;
                    $records[$key][3] = $qty;
                    $records[$key][4] = $dis;
                    $records[$key][5] = $vat;
                    $records[$key][6] = $this->getTotal($up, $qty, $dis, $vat);
                    $isNew = false;
                    break;
                }
            }

            if ($isNew == true) {
                $records[] = [$ic, $bin_location, $up, $qty, $dis, $vat, $this->getTotal($up, $qty, $dis, $vat), $item];
            }

            Session::put('pod', $records);
            // Session::put('subtotal', $this->calculateSubTotals($this->sessionRecords()));
            return ['subtotal' => $this->calculateSubTotals($records)];
            return 3;

        } else {
            if (!$nullCheck) {
                return 1;
            } else if (!$item) {
                return 2;
            }
        }
    }

    public function CalculateSessionTotal(Request $request)
    {
        $amount = [$this->calculateSubTotals($this->sessionRecords()), $this->getPoNetTot($request->dis, $request->vat)];
        return $amount;
    }

    public function sessionPOItemRemove(Request $request)
    {

        $index = $request->item_index;

        $records = $this->sessionRecords();
        if (count($records) > 0) {
            array_splice($records, $index, 1);
            Session::put('pod', $records);
            return ['subtotal' => $this->calculateSubTotals($records)];
        } else {
            return 2;
        }

    }

    protected function getTotal($up, $qty, $dis, $vat)
    {
        $total = 0;

        if (($dis == null && $vat == null) || ($dis == 0 && $vat == 0)) {
            $total = $up * $qty;
        } else if (($dis != null && $vat == null) || ($dis != 0 && $vat == 0)) {
            $total = ($up * $qty) * (100 - $dis) / 100;
        } else if (($dis == null && $vat != null) || ($dis == 0 && $vat != 0)) {
            $total = ($up * $qty) * (100 + $vat) / 100;
        } else if (($dis != null && $vat != null) || ($dis != 0 && $vat != 0)) {
            $total = (($up * $qty) * (100 - $dis) / 100) * (100 + $vat) / 100;
        }

        return round($total, 2);
    }

    public function savePO(Request $request)
    {

        $po_code = $request->po_code;
        $discount = $request->discount;
        $tot_vat = $request->tot_vat;

        // $request->validate([
        //     'po_code' => 'required',
        //     'location_id' => 'required',
        //     'supplier_id' => 'required',
        //     'po_date' => 'required',
        //     'discount' => 'nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:5',
        //     'tot_vat' => 'nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:5',
        // ]);

        $validator = Validator::make($request->all(), [
            'po_code' => 'required',
            'location_id' => 'required',
            'supplier_id' => 'required',
            'po_date' => 'required',
            'discount' => 'nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:5',
            'tot_vat' => 'nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $isValid = true;

        if ((new supplier)->getSupplierByCode(explode('-', $request->supplier_id)[0]) == null) {
            $isValid = false;
            return redirect()->back()->with(['code' => 1, 'color' => 'danger', 'msg' => 'Please add a valid bin location or valid supplier']);
        }

        if (!$request->session()->has('pod') || $this->calculateSubTotals($request->session()->get('pod')) <= 0) {
            $isValid = false;
            return redirect()->back()->with(['code' => 1, 'color' => 'danger', 'msg' => 'Please add items for purchase order']);
        }

        $sub_tot = $this->calculateSubTotals($request->session()->get('pod'));

        $po_net_tot = 0;

        if ($isValid) {

            $po_net_tot = $this->getPoNetTot($discount, $tot_vat);

            $create_date = DateTime::createFromFormat('d/m/Y', $request->po_date);

            if ($request->po_expt_deliver_date != '') {
                $deliver_date = DateTime::createFromFormat('d/m/Y', $request->po_expt_deliver_date);
            }

            if (purchase_order::where('po_code', $po_code)->first()) {

                // Update Code...

            } else {

                if ($request->po_expt_deliver_date == '') {

                    $data = [

                        // 'po_code' => 'PO/' . date('mys') . '/' . str_pad((new purchase_order)->getPoCount() + 1, 3, '0', STR_PAD_LEFT),
                        'po_code' => $request->po_code,
                        'location_id' => $request->location_id,
                        'supplier_id' => (new supplier)->getSupplierByCode(explode('-', $request->supplier_id)[0])->id,
                        'approved_quotation_code' => $request->approved_quotation_code,
                        'po_date' => $create_date,
                        'po_tot' => $sub_tot,
                        'discount' => $discount,
                        'tot_vat' => $tot_vat,
                        'po_net_tot' => $po_net_tot,
                        'remark' => $request->remark,
                        'status' => 3,
                    ];
                } else {

                    $data = [

                        // 'po_code' => 'PO/' . date('mys') . '/' . str_pad((new purchase_order)->getPoCount() + 1, 3, '0', STR_PAD_LEFT),
                        'po_code' => $request->po_code,
                        'location_id' => $request->location_id,
                        'supplier_id' => (new supplier)->getSupplierByCode(explode('-', $request->supplier_id)[0])->id,
                        'approved_quotation_code' => $request->approved_quotation_code,
                        'po_date' => $create_date,
                        'po_expected_deliver_date' => $deliver_date,
                        'po_tot' => $sub_tot,
                        'discount' => $discount,
                        'tot_vat' => $tot_vat,
                        'po_net_tot' => $po_net_tot,
                        'remark' => $request->remark,
                        'status' => 3,
                    ];

                }

                $po = (new purchase_order)->add($data);

                $records = $this->sessionRecords();

                foreach ($records as $key => $po_item) {

                    $po_item_data = [

                        'po_id' => $po->id,
                        'bin_location_id' => $po_item[1]->id,
                        'item_id' => $po_item[7]->id,
                        'qty' => $po_item[3],
                        'unit_price' => $po_item[2],
                        'sub_tot' => $po_item[3] * $po_item[2],
                        'discount' => $po_item[4],
                        'vat' => $po_item[5],
                        'net_tot' => $po_item[6],
                        'status' => 1,

                    ];

                    (new po_has_items)->add($po_item_data);

                }

                $this->sessionPOClear($request);

                return response()->json(['success' => 'Added new records.']);

                // $poCode = 'PO/' . date('smy') . '/' . str_pad((new purchase_order)->getPoCount() + 1, 3, '0', STR_PAD_LEFT);
                // $location = (new Location)->getActiveAll();

                // return redirect()->back()->with(['poCode' => $poCode, 'location' => $location, 'code' => 1]);

            }

        }

    }

    public function getPoNetTot($discount, $tot_vat)
    {
        $po_net_tot = 0;
        $sub_tot = $this->calculateSubTotals($this->sessionRecords());

        if ($discount == '' && $tot_vat == '') {
            $po_net_tot = $sub_tot;
            $discount = 0;
            $tot_vat = 0;
        } else if ($discount != '' && $tot_vat == '') {
            $po_net_tot = $sub_tot * ((100 - $discount) / 100);
            $tot_vat = 0;
        } else if ($discount == '' && $tot_vat != '') {
            $po_net_tot = $sub_tot * ((100 + $tot_vat) / 100);
            $discount = 0;
        } else if ($discount != '' && $tot_vat != '') {
            $po_net_tot = $sub_tot * ((100 - $discount) / 100) * ((100 + $tot_vat) / 100);
        }
        return round($po_net_tot, 2);
    }

    public function viewPO(Request $request)
    {
        // $request->session()->put('selectedPO', $request->po_id);
        $po = (new purchase_order)->getPObyId($request->po_id);
        $location = location::find($po->location_id);
        $supplier = supplier::find($po->supplier_id);
        $complete_data[0] = $po;
        $complete_data[1] = $location;
        $complete_data[2] = $supplier;

        $request->session()->put('selectedPurchaseOrder', $po);
        $request->session()->put('selectedPurchaseOrderLocation', $location);
        $request->session()->put('selectedPurchaseOrderSupplier', $supplier);

        return response()->json($complete_data);
    }

    public function poItemSavedData(Request $request)
    {
        $poItemtableData = [];

        if ($request->session()->has('selectedPurchaseOrder')) {

            $po_status = $request->session()->get('selectedPurchaseOrder')->status;

            $po_items = po_has_items::where('po_id', $request->session()->get('selectedPurchaseOrder')->id)->get();

            foreach ($po_items as $key => $item) {

                $poItemtableData[] = [item::find($item->item_id)->item_part_code . '-' . item::find($item->item_id)->item_name, bin_location::find($item->bin_location_id)->bin_location_name, $item->unit_price, $item->qty, $item->discount, $item->vat, 'LKR ' . number_format($item->net_tot, 2, '.', ','), ($item->status == 1) ? '
                <td class="py-1 align-middle">
                <span class="badge bg-green-100 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                            class="fa fa-circle text-teal fs-9px fa-fw me-5px"></i>
                        Active
                </span>
                </td>
                ' : '
                <td class="py-1 align-middle">
                <span class="badge bg-red-100 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                    <i class="fa fa-circle text-danger fs-9px fa-fw me-5px"></i>Deactive
                </span>
                </td>
                ',
                ($po_status == 3)?'
                <td class="py-1 align-middle">
                <div class="input-group flex-nowrap">
                    <div class="m-1">
                        <button class="btn btn-round btn-default btn-sm" onclick="viewPOItemFromDb(' . $item->id . ')">View / Edit</button>
                    </div>
                    <div class="m-1">
                        <button class="btn btn-round btn-outline-danger btn-sm" onclick="removePOItemFromDb(' . $item->id . ')">Remove </button>
                    </div>
                </div>
                </td>
                ':'
                <td class="py-1 align-middle">
                    <span class="badge bg-black-200 text-white px-2 m-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                        <i class="fa fa-circle text-white fs-9px fa-fw me-5px"></i>Unable to edit
                    </span>
                </td>',
                ];
            }

        }
        return $poItemtableData;
    }

    public function UpdateSelectedPoFromDb(Request $request)
    {

        $po_item = (new po_has_items)->getItemforUpdate($request);

        if ($po_item) {

            if ($request->discount == '') {
                $request->discount = 0;
            }

            if ($request->vat == '') {
                $request->vat = 0;
            }

            $po_item->bin_location_id = $request->bin_location_id;
            $po_item->qty = $request->qty;
            $po_item->unit_price = $request->unit_price;
            $po_item->sub_tot = ($request->qty) * ($request->unit_price);
            $po_item->discount = $request->discount;
            $po_item->vat = $request->vat;
            $po_item->net_tot = $this->getTotal($request->unit_price, $request->qty, $request->discount, $request->vat);

            $po_item->save();

            return $this->UpdatePurchaseOrderFromDB($request);

        } else {

            $po_item_data = [

                'po_id' => $request->session()->get('selectedPurchaseOrder')->id,
                'bin_location_id' => $request->bin_location_id,
                'item_id' => $request->item_id,
                'qty' => $request->qty,
                'unit_price' => $request->unit_price,
                'sub_tot' => ($request->qty) * ($request->unit_price),
                'discount' => $request->discount,
                'vat' => $request->vat,
                'net_tot' => $this->getTotal($request->unit_price, $request->qty, $request->discount, $request->vat),
                'status' => 1,

            ];

            (new po_has_items)->add($po_item_data);

            return $this->UpdatePurchaseOrderFromDB($request);

        }

    }

    public function UpdatePurchaseOrderFromDB(Request $request)
    {

        $po = (new purchase_order)->where('id', $request->session()->get('selectedPurchaseOrder')->id)->first();

        $po->approved_quotation_code = $request->approved_quotation_code;
        $po->po_expected_deliver_date = $request->po_expt_deliver_date;
        $po->po_tot = $this->getTotalOfSelectedPoItems();
        $po->discount = $request->tot_discount;
        $po->tot_vat = $request->tot_vat;
        $po->po_net_tot = $this->getPoNetTotOfDb($request->tot_discount, $request->tot_vat, $this->getTotalOfSelectedPoItems());
        $po->remark = $request->remark;

        $po->save();

        return $po;

    }

    public function getTotalOfSelectedPoItems()
    {

        $total = 0;
        $po_items = po_has_items::where('po_id', Session::get('selectedPurchaseOrder')->id)->get();

        foreach ($po_items as $key => $item) {
            $total += $item->net_tot;
        }
        return $total;
    }

    public function getPoNetTotOfDb($discount, $tot_vat, $sub_tot)
    {
        $po_net_tot = 0;

        if ($discount == '' && $tot_vat == '') {
            $po_net_tot = $sub_tot;
            $discount = 0;
            $tot_vat = 0;
        } else if ($discount != '' && $tot_vat == '') {
            $po_net_tot = $sub_tot * ((100 - $discount) / 100);
            $tot_vat = 0;
        } else if ($discount == '' && $tot_vat != '') {
            $po_net_tot = $sub_tot * ((100 + $tot_vat) / 100);
            $discount = 0;
        } else if ($discount != '' && $tot_vat != '') {
            $po_net_tot = $sub_tot * ((100 - $discount) / 100) * ((100 + $tot_vat) / 100);
        }
        return round($po_net_tot, 2);
    }

    public function calculateDbTotal(Request $request)
    {

        $net_total = $this->getPoNetTotOfDb($request->dis, $request->vat, $this->getTotalOfSelectedPoItems());

        $po = (new purchase_order)->where('id', $request->session()->get('selectedPurchaseOrder')->id)->first();
        $po->discount = $request->dis;
        $po->tot_vat = $request->vat;
        $po->po_net_tot = $net_total;

        $po->save();

        return $net_total;

    }

    public function ChangeStatusPoItemFromDb(Request $request)
    {
        po_has_items::where('id', $request->id)->delete();

        return $this->UpdatePurchaseOrderFromDB($request);
    }

    public function ViewPOItems(Request $request)
    {
        $po_item = po_has_items::where('id', $request->id)->first();

        $data[] = $po_item;
        $data[] = item::find($po_item->item_id);

        $bins = bin_location::where([
            ['item_id', $po_item->item_id],
            ['location_id', purchase_order::find($po_item->po_id)->location_id],
        ])->get();

        $bin_arr = [];

        foreach ($bins as $key => $bin) {
            $bin_arr[] = $bin;
        }

        $data[] = $bin_arr;

        return response()->json($data);
    }

    public function updatePo(Request $request)
    {
        $po = (new purchase_order)->where('id', $request->session()->get('selectedPurchaseOrder')->id)->first();

        $po->approved_quotation_code = $request->approved_quotation_code;
        $po->po_expected_deliver_date = $request->po_expt_deliver_date;
        $po->remark = $request->remark;

        $po->save();

        return $po;
    }

    public function approvePo(Request $request)
    {
        $po = (new purchase_order)->where('id', $request->session()->get('selectedPurchaseOrder')->id)->first();
        $po->po_approved_person = Auth::user()->id;
        $po->po_approved_date = date('Y-m-d');
        $po->status = 1;

        $po->save();

        return 1;

    }

    public function refusePo(Request $request)
    {
        $po = (new purchase_order)->where('id', $request->session()->get('selectedPurchaseOrder')->id)->first();
        $po->po_approved_person = Auth::user()->id;
        $po->po_approved_date = date('Y-m-d');
        $po->status = 2;

        $po->save();

        return 1;

    }

    public function counts()
    {

        $active = (new purchase_order)->where('status', 1)->count();
        $deactive = (new purchase_order)->where('status', 2)->count();
        $pending = (new purchase_order)->where('status', 3)->count();
        $all = (new purchase_order)->getPoCount();

        $data = [$active, $deactive, $pending, $all];

        return $data;

    }

}
