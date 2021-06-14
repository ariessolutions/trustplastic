<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GRN extends Model
{
    use HasFactory;

    protected $fillable = ['po_id', 'grn_code', 'remark', 'grn_status', 'grn_total', 'location_id'];

    public function createGrn($poid, $grncode, $remark, $grntotal, $location_id)
    {
        $data = [
            'grn_code' => $grncode,
            'remark' => $remark,
            'grn_total' => $grntotal,
            'location_id' => $location_id,
            'po_id' => $poid,
        ];

        return $this->create($data);
    }

    public function getNextId()
    {
        return DB::select("SHOW TABLE STATUS LIKE 'g_r_n_s'")[0]->Auto_increment;
    }

    public function getAll($status = 1)
    {
        return $this::where('grn_status', $status)->with('poitems')->with('location')->with('po')->orderBy('id','DESC')->get();
    }

    public function poitems()
    {
        return $this->hasMany(po_has_items::class, 'po_id', 'id');
    }

    public function location()
    {
        return $this->hasOne(location::class, 'id', 'location_id');
    }

    public function po()
    {
        return $this->hasOne(purchase_order::class, 'id', 'po_id')->with('supplier');
    }

    public function grnitems()
    {
        return $this->hasMany(GRNHasItems::class, 'grn_id', 'id')->with('item');
    }

    public function getGrn($id)
    {
        return $this::where('id', $id)->with('grnitems')->with('po')->with('location')->first();
    }

    public function getStock($data, $binWise = false)
    {
        $query = StockHasItems::where('status', 1);

        if ($data['startgrndate'] != null) {
            $query->whereDate('created_at', '>=', Carbon::parse($data['startgrndate']));
        }

        if ($data['endgrndate'] != null) {
            $query->whereDate('created_at', '<=', Carbon::parse($data['endgrndate']));
        }

        if ($data['binlocation'] != null) {
            $query->where('bin_location_id', $data['binlocation']);
        }

        if ($data['item_id'] != null) {
            $query = $query->where('item_id', $data['item_id']);
        }

        if ($data['locationid'] != null) {
            $query->whereIn('stock_id', (new Stock)->getLocationStocks($data['locationid']));
        }

        if ($data['grnid'] != null) {
            $query->whereIn('stock_id', (new Stock)->getGrnStocks($data['grnid']));
        }

        if ($binWise == false) {
            return $query->selectRaw("item_id,SUM(qty) as totqty")
                ->groupBy('item_id')->orderBy('id','DESC')->get();
        } else {
            return $query->selectRaw("item_id,bin_location_id,SUM(qty) as totqty")
                ->groupBy('bin_location_id')->orderBy('id','DESC')->get();
        }
    }

    public function suggetions($input)
    {
        return $this::where([
            ['grn_status', '=', 1],
            ["grn_code", "LIKE", "%{$input['query']}%"],
        ])->get();
    }
}
