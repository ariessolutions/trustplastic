<?php

namespace App\Http\Controllers;

use App\Models\GRN;
use App\Models\item;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.pages.stock')->with('data',[
            'locations'=>(new LocationController)->getLocations()
        ]);
    }


    public function tableView($itemid,$grnid,$from,$to,$bin)
    {

        $filters=[
            'startgrndate'=>null,
            'endgrndate'=>null,
            'binlocation'=>null,
            'grnid'=>null,
            'item_id'=>null
        ];


        if($itemid!='0'){
            $filters['item_id']=$itemid;
        }
        if($grnid!='0'){
            $filters['grnid']=$grnid;
        }
        if($from!='0'){
            $filters['startgrndate']=$from;
        }
        if($to!='0'){
            $filters['endgrndate']=$to;
        }
        if($bin!='0'){
            $filters['binlocation']=$bin;
        }


        $tableData = [];

        foreach ((new GRN)->getStock($filters) as $key => $record) {
            $item=(new item)->getItemById($record['item_id']);
            $tableData[] = [$key+1 ,$item->item_code,$item->item_part_code,$item->item_name,$record->totqty.' '.$item['munit']['symbol'],($record->totqty<5)?'<span class="badge bg-green-100 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle text-teal fs-9px fa-fw me-5px"></i>AVAILABLE</span>':'-','<span class="badge bg-' . (($record->totqty>0) ? 'green' : 'red') . '-100 text-' . (($record->totqty>0) ? 'success' : 'danger') . ' px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle text-' . (($record->totqty>0) ? 'teal' : 'danger') . ' fs-9px fa-fw me-5px"></i>' . (($record->totqty>0) ? 'AVAILABLE' : 'NO AVAILABLE') . '</span>'];
        }

        return $tableData;
    }
}
