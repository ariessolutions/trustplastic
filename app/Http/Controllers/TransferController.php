<?php

namespace App\Http\Controllers;

use App\Models\bin_location;
use App\Models\item;
use App\Models\Stock;
use App\Models\StockHasItems;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class TransferController extends Controller
{
    protected $sessionKey = 'iltsession';

    protected $stockHasItemObj;

    public function __construct()
    {
        $this->stockHasItemObj = new StockHasItems();
    }

    public function index()
    {

        if (!Session::has('isTransferEnroll')) {
            $this->clearSession();
            Session::forget('isTransferEnroll');
        }

        $data = [
            'locations' => (new LocationController)->getLocations(),
        ];
        return view('dashboard.pages.transfer')->with('data', $data);
    }

    public function itemSuggetions($from, Request $request)
    {
        $data = array();

        foreach ((new item)->suggetionsFrom($from, $request->all()) as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => '(' . $item->item_code . ')' . ' - ' . $item->item_name,
            ];
        }

        return response()->json($data, 200);
    }

    protected function sessionData($data = [], $clear = false)
    {
        if ($clear) {
            Session::put($this->sessionKey, []);
        }

        if (count($data) > 0) {
            Session::put($this->sessionKey, $data);
        }

        return Session::get($this->sessionKey, []);
    }

    public function addToSession($itemId, $quantity, $binLocation, $from)
    {
        $data = $this->sessionData();

        $binLocationData = (new bin_location)->getBinLocationById($binLocation);
        $stockCheck = true;
        if (count($data) > 0) {
            $check = true;

            foreach ($data as $key => $value) {
                if ($value[0]->id == $itemId) {
                    $data[$key][1] = $data[$key][1] + $quantity;
                    $data[$key][2] = $binLocation;
                    $data[$key][3] = $binLocationData;
                    $check = false;
                    $stockCheck = $this->checkQuantityIsValid($itemId, $data[$key][1] + $quantity, $from);
                    break;
                }
            }

            if ($check) {
                $stockCheck = $this->checkQuantityIsValid($itemId, $quantity, $from);
                $data[] = [(new ItemController)->getItemById($itemId), $quantity, $binLocation, $binLocationData];
            }
        } else {
            $stockCheck = $this->checkQuantityIsValid($itemId, $quantity, $from);
            $data[] = [(new ItemController)->getItemById($itemId), $quantity, $binLocation, $binLocationData];
        }
        if ($stockCheck) {
            $this->sessionData($data);
            return count($data);
        } else {
            return 'error';
        }
    }

    private function checkQuantityIsValid($item, $qty, $from)
    {
        return ((new StockHasItems)->getItemStockQuantity($item, $from) >= $qty) ? true : false;
    }

    public function clearSession()
    {
        $this->sessionData([], true);
    }

    public function removeFromSession($index)
    {
        $data = $this->sessionData();

        array_splice($data, $index, 1);

        $this->sessionData($data, true);
    }

    public function add(Request $request)
    {
        Session::put('isTransferEnroll', true);
        $data = $this->sessionData();
        if (count($data) > 0) {
            $request->validate([
                'transfer_location_from' => 'required|integer|exists:locations,id',
                'transfer_location_to' => 'required|integer|exists:locations,id|different:from',
                'transfer_remark' => 'nullable|string',
            ]);

            $trasactionData = [
                'code' => $this->genarateNextId(),
                'from' => $request->transfer_location_from,
                'to' => $request->transfer_location_to,
            ];

            if ($request->has('transfer_remark')) {
                $trasactionData['remark'] = $request->remark;
            }

            $transaction = (new Transaction)->createRecord($trasactionData);

            $stock = (new Stock)->createRecord([
                'transfer_id' => $transaction->id,
                'location_id' => $request->transfer_location_to,
                'status' => 1,
            ]);

            foreach ($data as $key => $value) {
                $qty = $value[1];
                $records = $this->stockHasItemObj->getByItemId($value[0]->id);
                foreach ($records as $key1 => $value1) {
                    if ($value1->qty >= $qty) {
                        $this->stockHasItemObj->updateRecord($value1->id, ['qty' => ($value1->qty - $qty)]);
                        if (($value1->qty - $qty) == 0) {
                            $this->stockHasItemObj->createRecord([
                                'stock_id' => $stock->id,
                                'item_id' => $value[0]->id,
                                'bin_location_id' => $value[2],
                                'qty' => $qty,
                                'unit_price' => $value1->unit_price,
                            ]);
                            break;
                        }
                    } else {
                        $qty = $qty - $value1->qty;
                        $this->stockHasItemObj->updateRecord($value1->id, ['qty' => 0]);
                        $this->stockHasItemObj->createRecord([
                            'stock_id' => $stock->id,
                            'item_id' => $value[0]->id,
                            'bin_location_id' => $value[2],
                            'qty' => $value1->qty,
                            'unit_price' => $value1->unit_price,
                        ]);

                        if ($qty == 0) {
                            break;
                        }
                    }
                }
            }

            $this->clearSession();
            Session::forget('isTransferEnroll');
            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Job ' . (($request->formconfig == 'update') ? 'Updated' : 'Submitted') . 'Transfer Submitted Successfully.']);
        } else {
            throw ValidationException::withMessages(['commonerror' => 'No Transfer Products Available.']);
        }
    }

    public function next()
    {
        return $this->genarateNextId();
    }

    public function genarateNextId()
    {
        return env('JOBPREFIX', '') . str_pad((new Transaction)->getNextId(), 3, "0", STR_PAD_LEFT);
    }

    public function getItemBins($item, $to, $from)
    {
        $data = (new bin_location)->getBinLocationByItemAndLocation($item, $to);
        $aqty = (new StockHasItems)->getItemStockQuantity($item, $from);
        foreach ($data as $key => $value) {
            $data[$key]['aqty'] = $aqty;
            $data[$key]['symbol'] = $value['item']['munit']['symbol'];
        }
        return (count($data) == 0) ? 2 : $data;
    }

    public function getModalTable()
    {
        $data = [];
        foreach ($this->sessionData() as $key => $value) {
            $data[] = [$key + 1, $value[0]->item_code, $value[0]->item_name, $value[3]->bin_location_name, $value[1], ((Session::has('transferView') == false) ? '<div class="input-group flex-nowrap">
            <div class="m-1">
                <a style="width:80px" class="btn btn-round btn-outline-danger btn-sm" onclick="transferRemoveFromSession(' . $key . ')">
                    Remove
                </a>
            </div>
            </div>' : '-')];
        }
        Session::forget('transferView');
        return $data;
    }

    public function getTableView($from, $to)
    {
        if ($from == '0') {
            $from = null;
        }

        if ($to == '0') {
            $to = null;
        }

        $data = (new Stock)->getTransfers(['start' => $from, 'end' => $to]);

        foreach ($data as $key => $value) {
            $data[$key] = [$key + 1, $value->code, $value['fromData']->location_name . ', ' . $value['fromData']->location_address, $value['toData']->location_name . ', ' . $value['toData']->location_address, $value['userData']->fname, $value->created_at->format('d/m/Y'), '<div class="input-group flex-nowrap">
            <div class="m-1">
                <a class="btn btn-secondary btn-sm" onclick="viewTransfer(' . $value->id . ')">
                    View
                </a>
                <a class="btn btn-default btn-sm" onclick="printTransfer(' . $value->id . ')">
                <i class="fa fa-print" aria-hidden="true"></i> Print
                </a>
            </div>
        </div>', ];
        }

        return $data;
    }

    public function viewTransfer($tid)
    {
        Session::put('transferView', 1);

        $obj = (new Transaction)->getData($tid);

        $this->clearSession();

        foreach ($obj['stock']['stock_items'] as $key => $value) {
            $this->addToSession($value->item_id,$value->qty,$value->bin_location_id,$obj->from);
        }

        return $obj;

    }

    public function printTransfer($tid)
    {
        return view('reports.transferReport')->with('data',(new Transaction)->getData($tid));
    }
}
