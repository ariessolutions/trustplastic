<?php

namespace App\Http\Controllers;

use App\Models\bin_location;
use App\Models\GRN;
use App\Models\item;
use App\Models\location;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.pages.stock')->with('data', [
            'locations' => (new LocationController)->getLocations(),
        ]);
    }

    public function tableView($itemid, $grnid, $from, $to, $bin, $locationid)
    {
        $tableData = [];

        foreach ($this->getRecordsFromFilters($itemid, $grnid, $from, $to, $bin, $locationid) as $key => $record) {
            $item = (new item)->getItemById($record['item_id']);
            $tableData[] = [$key + 1, $item->item_code, $item->item_part_code, $item->item_name, $record->totqty . ' ' . $item['munit']['symbol'], ($record->totqty < 5) ? '<span class="badge bg-green-100 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle text-teal fs-9px fa-fw me-5px"></i>Available</span>' : '-', '<span class="badge bg-' . (($record->totqty > 0) ? 'green' : 'red') . '-100 text-' . (($record->totqty > 0) ? 'success' : 'danger') . ' px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle text-' . (($record->totqty > 0) ? 'teal' : 'danger') . ' fs-9px fa-fw me-5px"></i>' . (($record->totqty > 0) ? 'Available' : 'Unavailable') . '</span>'];
        }

        return $tableData;
    }

    public function getRecordsFromFilters($itemid, $grnid, $from, $to, $bin, $locationid)
    {

        $filters = [
            'startgrndate' => null,
            'endgrndate' => null,
            'binlocation' => null,
            'locationid' => null,
            'grnid' => null,
            'item_id' => null,
        ];

        if ($itemid != '0') {
            $filters['item_id'] = $itemid;
        }
        if ($grnid != '0') {
            $filters['grnid'] = $grnid;
        }
        if ($from != '0') {
            $filters['startgrndate'] = $from;
        }
        if ($to != '0') {
            $filters['endgrndate'] = $to;
        }
        if ($bin != '0') {
            $filters['binlocation'] = $bin;
        }
        if ($locationid != '0') {
            $filters['locationid'] = $locationid;
        }

        return (new GRN)->getStock($filters);
    }

    public function printReport($itemid, $grnid, $from, $to, $bin, $locationid)
    {
        $filters = [
            'grn' => (new GRN)->getGrn($grnid),
            'item' => (new item)->getItemById($itemid),
            'from' => $from,
            'to' => $to,
            'location' => (new location)->getLocationbyId($locationid),
            'bin' => (new bin_location)->getBinLocationById($bin),
        ];

        $records = [];

        $recs = $this->getRecordsFromFilters($itemid, $grnid, $from, $to, $bin, $locationid);

        if (count($recs) > 0) {
            foreach ($recs as $key => $record) {
                $records[] = [(new item)->getItemById($record['item_id']), $record];
            }

            return view('reports.stockReport')->with('data', ['filters' => $filters, 'records' => $records]);
        } else {
            return 2;
        }
    }
}
