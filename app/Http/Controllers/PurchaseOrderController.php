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
use Illuminate\Support\Facades\Session;

class PurchaseOrderController extends Controller
{

    public function index(Request $request)
    {

        $isReferesh = true;

        $poCode = 'PO/' . date('smy') . '/' . str_pad((new purchase_order)->getPoCount() + 1, 3, '0', STR_PAD_LEFT);
        $location = (new Location)->getActiveAll();

        if (!$request->session()->has('refresh_status')) {
            $this->sessionPOClear($request);
        } else {
            $request->session()->forget('refresh_status');

            if ($request->session()->has('pod')) {
                $records = $this->sessionRecords();
                $subtotal = $this->calculateSubTotals($this->sessionRecords());
                return view('dashboard.purchase_order_requests', compact('poCode', 'location', 'records', 'subtotal'));
            } else {
                return view('dashboard.purchase_order_requests', compact('poCode', 'location'));
            }

        }

        return view('dashboard.purchase_order_requests', compact('poCode', 'location'));

    }

    public function loadBinLocation(Request $request)
    {
        $input = $request->all();

        $bin_location_list = bin_location::Where([
            ['status', '=', 1],
            ["location_id", "=", $input['location']],
            ["bin_location_name", "LIKE", "%{$input['query']}%"],
        ])->get();

        $data = array();

        foreach ($bin_location_list as $bin_location) {
            $data[] = $bin_location->bin_location_name;
        }

        return response()->json($data);
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
        $input = $request->all();

        $item_list = item::Where([
            ['status', '=', 1],
            ["item_code", "LIKE", "%{$input['query']}%"],
        ])
            ->orWhere([
                ['status', '=', 1],
                ["item_name", "LIKE", "%{$input['query']}%"],
            ])
            ->get();

        $data = array();

        foreach ($item_list as $item) {
            $data[] = $item->item_code . '-' . $item->item_name;
        }

        return response()->json($data);
    }

    public function sessionRecords()
    {
        return Session::get('pod', []);
    }

    public function tableView($records)
    {
        return view('dashboard.components.potable')->with('records', $records);
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
        $up = $request->up;
        $qty = $request->qty;
        $dis = $request->dis;
        $vat = $request->vat;

        if (($ic != '') && ($up != '') && ($qty != '') && ($up > 0) && ($qty > 0) && ($dis >= 0) && ($vat >= 0)) {

            if ($dis == '') {
                $dis = 0;
            }

            if ($vat == '') {
                $vat = 0;
            }

            $nullCheck = true;

        } else {
            $nullCheck = false;
        }

        $item = (new Item)->getItemByCode($ic);

        if ($nullCheck && $item) {
            $records = $this->sessionRecords();

            $isNew = true;

            foreach ($records as $key => $value) {
                if ($value[0] == $ic) {
                    $records[$key][1] = $up;
                    $records[$key][2] = $qty;
                    $records[$key][3] = $dis;
                    $records[$key][4] = $vat;
                    $records[$key][5] = $this->getTotal($up, $records[$key][2], $dis, $vat);
                    $isNew = false;
                    break;
                }
            }

            if ($isNew == true) {
                $records[] = [$ic, $up, $qty, $dis, $vat, $this->getTotal($up, $qty, $dis, $vat), $item];
            }
            Session::put('pod', $records);
            return ['subtotal' => $this->calculateSubTotals($records), "tbody" => $this->tableView($records)->render()];

        } else {
            if (!$nullCheck) {
                return 1;
            } else if (!$item) {
                return 2;
            }
        }
    }

    public function sessionPOItemRemove(Request $request)
    {

        $index = $request->item_index;

        $records = $this->sessionRecords();
        if (count($records) > 0) {
            array_splice($records, $index, 1);
            Session::put('pod', $records);
            return ['subtotal' => $this->calculateSubTotals($records), "tbody" => $this->tableView($records)->render()];
        } else {
            return 2;
        }

    }

    public function sessionPOClear(Request $request)
    {

        if ($request->session()->has('pod')) {
            $request->session()->forget('pod');

            return view('dashboard.components.potable')->with('records', $this->sessionRecords($request));

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

    public function calculateSubTotals($records)
    {
        $total = 0;
        foreach ($records as $key => $value) {
            $total += $value[5];
        }
        return round($total, 2);
    }

    public function savePO(Request $request)
    {

        $po_code = $request->po_code;
        $discount = $request->discount;
        $tot_vat = $request->tot_vat;

        $request->session()->put('refresh_status', false);

        $request->validate([
            'po_code' => 'required',
            'location_id' => 'required',
            'bin_location_id' => 'required',
            'supplier_id' => 'required',
            'po_date' => 'required',
            'discount' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:5',
            'tot_vat' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0|max:5',
        ]);

        $isValid = true;

        if ((new supplier)->getSupplierByCode(explode('-', $request->supplier_id)[0]) == null || (new bin_location)->getBinLocationByCode($request->bin_location_id) == null) {
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

            $create_date = DateTime::createFromFormat('d/m/Y', $request->po_date);

            if ($request->po_expt_deliver_date != '') {
                $deliver_date = DateTime::createFromFormat('d/m/Y', $request->po_expt_deliver_date);
            }

            if (purchase_order::where('po_code', $po_code)->first()) {

                //Update Code...

            } else {

                if ($request->po_expt_deliver_date == '') {

                    $data = [

                        'po_code' => 'PO/' . date('mys') . '/' . str_pad((new purchase_order)->getPoCount() + 1, 3, '0', STR_PAD_LEFT),
                        'location_id' => $request->location_id,
                        'bin_location_id' => (new bin_location)->getBinLocationByCode($request->bin_location_id)->id,
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

                        'po_code' => 'PO/' . date('mys') . '/' . str_pad((new purchase_order)->getPoCount() + 1, 3, '0', STR_PAD_LEFT),
                        'location_id' => $request->location_id,
                        'bin_location_id' => (new bin_location)->getBinLocationByCode($request->bin_location_id)->id,
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
                        'item_id' => $po_item[6]->id,
                        'qty' => $po_item[2],
                        'unit_price' => $po_item[1],
                        'sub_tot' => $po_item[2]*$po_item[1],
                        'discount' => $po_item[3],
                        'vat' => $po_item[4],
                        'net_tot' => $po_item[5],
                        'status' => 1,

                    ];

                    (new po_has_items)->add($po_item_data);

                }

                $request->session()->forget('refresh_status');
                $request->session()->forget('pod');
                return 'successfull';

            }

        }

    }

}
