<?php

namespace App\Http\Controllers;

use App\Models\GRN;
use App\Models\GRNHasItems;
use App\Models\po_has_items;
use App\Models\purchase_order;
use App\Models\Stock;
use App\Models\StockHasItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GRNController extends Controller
{
    public function index()
    {
        if (Session::get('grnadd', 2) == 1) {
            Session::put('grnadd', 2);
        } else {
            Session::put('grnrecords', []);
        }

        $data = [
            'active' => count((new GRN)->getAll(1)),
            'deactive' => count((new GRN)->getAll(2)),
        ];

        return view('dashboard.grn')->with('data', $data);
    }

    public function getPOByCode(Request $request)
    {
        $po = (new purchase_order())->getPOByCode($request->code);

        $records = [];

        $recordsIndex = count($records);

        if ($po) {
            foreach ($po['poitems'] as $key => $value) {
                if ($value->status == 1) {
                    $records[$recordsIndex][0] = $value['item'];
                    $records[$recordsIndex][1] = $value->unit_price;
                    $records[$recordsIndex][2] = ($value->grn_in_qty == 0) ? $value->qty : $value->grn_in_qty;
                    $records[$recordsIndex][6] = ($value->grn_in_qty == 0) ? $value->qty : $value->grn_in_qty;
                    $records[$recordsIndex][7] = $value->id;
                    $records[$recordsIndex][8] = $value['item']['munit']->symbol;
                    $records[$recordsIndex][9] = $value->bin_location_id;
                    $records[$recordsIndex][4] = $value->discount;
                    $records[$recordsIndex][5] = $value->vat;
                    $records[$recordsIndex][3] = $this->getTotal($value->unit_price, (($value->grn_in_qty == 0) ? $value->qty : $value->grn_in_qty), $value->discount, $value->vat);
                    $recordsIndex++;
                }
            }
        }

        Session::put('grnrecords', $records);

        return ($po) ? $po : 2;
    }

    public function sessionRecords()
    {
        return Session::get('grnrecords', []);
    }

    public function removeRecordSesion($index)
    {
        $records = $this->sessionRecords();
        if (count($records) > 0) {
            array_splice($records, $index, 1);
            Session::put('grnrecords', $records);
        }
    }

    public function updateRecordSesion($index, $qty)
    {
        $records = $this->sessionRecords();
        if (count($records) > 0 && $records[$index][6] >= $qty) {
            $records[$index][2] = $qty;
            $records[$index][3] = $this->getTotal($records[$index][1], $records[$index][2], $records[$index][4], $records[$index][5]);

            Session::put('grnrecords', $records);
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

    public function getFinalTotal($sub_tot, $discount, $tot_vat)
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

        return $po_net_tot;
    }

    public function getGRNRecordsFromDB($grnID)
    {
        $grn = (new GRN())->getGrn($grnID);

        $records = [];

        foreach ($grn['grnitems'] as $key => $value) {
            if ($value->status == 1) {
                $records[$key][0] = $value['item'];
                $records[$key][1] = $value->unit_price;
                $records[$key][2] = $value->qty;
                $records[$key][7] = $value->id;
                $records[$key][8] = $value['item']['munit']->symbol;
                $records[$key][9] = $value->bin_location_id;
                $records[$key][3] = $value->subtotal;
            }
        }
        return $records;
    }

    public function getGRNView($id)
    {
        SESSION::put('grnid',$id);
    }

    public function suggetions(Request $request)
    {
        $data = array();

        foreach ((new GRN)->suggetions($request->all()) as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => $item->grn_code,
            ];
        }

        return response()->json($data, 200);
    }

    public function tableView()
    {
        $isSession=true;
        if (Session::has('grnid') && Session::get('grnid', null) != null) {
            $isSession=false;
            $records = $this->getGRNRecordsFromDB(Session::get('grnid', null));
        } else {
            $records = $this->sessionRecords();
        }

        $tableData = [];

        foreach ($records as $key => $item) {
            $tableData[] = [$item[0]['item_code'], env('CURRENCY').' ' . number_format($item[1], 2, '.', ','), $item[2] . ' ' . $item[8], ($isSession)?'<i '.((count($item)==7)?'':'onclick="editGRNItem(' . $key . ',' . $item[6] . ')"').' class="fa fa-edit text-warning">&nbsp;</i>':'--', 'LKR ' . number_format($item[3], 2, '.', ','), '
            <div class="input-group flex-nowrap">
            <div class="m-1">
               '.(($isSession)?' <a class="btn btn-round btn-default btn-sm"
               onclick="removeGRNItem(' . $key . ')">Remove
           </a>':'--').'
            </div>
        </div>'];
        }

        Session::put('grnid',null);

        return $tableData;
    }

    public function enroll(Request $request)
    {
        $records = $this->sessionRecords();
        if ($records) {
            Session::put('grnadd', 1);

            $request->validate([
                'grnpocode' => 'required|exists:purchase_orders,po_code',
                'grn_remark' => 'nullable|string',
            ]);

            $grnCode = $this->genarateCode();
            $grnTotal = 0;

            foreach ($records as $key => $value) {
                $grnTotal += $value[3];
            }

            $changed = [];

            $po = (new purchase_order)->fetchedByCode($request->grnpocode);

            $grnSaved = (new GRN)->createGrn($po->id, $grnCode, $request->grn_remark, $this->getFinalTotal($grnTotal, $po->discount, $po->tot_vat), $po->location_id);

            $stockSaved = (new Stock)->createRecord([
                'grn_id' => $grnSaved->id,
                'location_id' => $grnSaved->location_id,
                'status' => 1,
            ]);

            foreach ($records as $key => $value) {
                (new GRNHasItems)->createRecord([
                    'qty' => $value[2],
                    'unit_price' => $value[1],
                    'status' => 1,
                    'item_id' => $value[0]->id,
                    'grn_id' => $grnSaved->id,
                    'bin_location_id' => $value[9],
                    'vat' => $value[5],
                    'discount' => $value[5],
                    'subtotal' => $value[3],
                ]);

                (new po_has_items)->updateGrnInQty($value[7], $value[2]);

                (new StockHasItems)->createRecord([
                    'stock_id' => $stockSaved->id,
                    'item_id' => $value[0]->id,
                    'bin_location_id' => $value[9],
                    'qty' => $value[2],
                    'unit_price' => $value[1],
                ]);
            }

            (new purchase_order)->updateRecordWithCheckStatus($po->id);

            Session::put('grnadd', 2);

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'GRN Submitted Successfully.']);
        } else {
            return redirect()->back()->with(['code' => 2, 'color' => 'warning', 'msg' => 'No products found to process.']);
        }

    }

    protected function genarateCode()
    {
        return env('GRNPREFIX', '') . str_pad((new GRN)->getNextId(), 3, "0", STR_PAD_LEFT);
    }

    public function clearGRNSession()
    {
        Session::put('grnrecords', []);
        Session::put('grnadd', 2);
    }

    public function getAllData(Request $request)
    {

        $resp = [];

        $index = 1;

        foreach ((new GRN)->getAll() as $key => $value) {
            $resp[] = [$index, $value->grn_code, $value['po']['po_code'],$value['po']['supplier']['supplier_name'] ,$value['location']['location_name'] ,$value->created_at->format('d/m/Y'), env('CURRENCY').' ' . number_format($value->grn_total, 2, '.', ','),
                '<span class="badge bg-' . (($value->grn_status == 1) ? 'green' : 'red') . '-100 text-' . (($value->grn_status == 1) ? 'success' : 'danger') . ' px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center">
                <i class="fa fa-circle text-' . (($value->grn_status == 1) ? 'success' : 'danger') . ' fs-9px fa-fw me-5px"></i>' . (($value->grn_status == 1) ? 'Active' : 'Discontinued ') . '</span>',
                '<div class="input-group flex-nowrap">
            <div class="m-1">
                <a class="btn btn-secondary btn-sm" id="grnrecord'.$value->id.'" remark="'.$value['remark'].'" pocode="'.$value['po']['po_code'].'" onclick="viewGrn(' . $value->id . ')">
                    View
                </a>
            </div>
            <div class="m-1">
                <a onclick="printGRN('.$value->id.')" class="btn btn-round btn-default btn-sm" data-role="completed-deactivate">
                    Print
                </a>
            </div>
        </div>',
            ];
            $index++;
        }

        return $resp;
    }

    public function printReport($id)
    {
        $data=(new GRN)->getGRN($id);
        if($data){
            return view('reports.grnReport')->with('data',$data);
        }else{
            return 2;
        }


    }
}
