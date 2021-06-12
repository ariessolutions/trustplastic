<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class po_has_items extends Model
{
    use HasFactory;

    protected $fillable = [

        'po_id',
        'bin_location_id',
        'item_id',
        'qty',
        'grn_in_qty',
        'unit_price',
        'sub_tot',
        'discount',
        'vat',
        'net_tot',
        'status',

    ];

    public function add($data)
    {
        return $this->create($data);
    }

    public function getItemsbyPOId($po_id)
    {
        return $this::where('po_id', $po_id)->get();
    }

    public function getItemforUpdate(Request $request)
    {
        return $this::where([
            ['po_id', $request->session()->get('selectedPurchaseOrder')->id],
            ['item_id', $request->item_id],
        ])->first();
    }

    public function item()
    {
        return $this->hasOne(item::class, 'id', 'item_id')->with('munit');
    }

    public function bindata()
    {
        return $this->hasOne(bin_location::class, 'id', 'bin_location_id');
    }

    public function updateGrnInQty($poiid, $grnQty)
    {
        $rec = $this::where('id', $poiid)->first();

        if ($rec->grn_in_qty == 0 && $rec->qty <= $grnQty) {
            $rec->update([
                'status' => 4,
            ]);
        } else {
            $newQty = ((($rec->grn_in_qty == 0) ? $rec->qty : $rec->grn_in_qty) - $grnQty);
            $rec->update([
                'grn_in_qty' => $newQty,
            ]);

            if ($newQty == 0) {
                $rec->update([
                    'status' => 4,
                ]);
            }
        }
    }

    public function getNonGRNZeros($poid)
    {
        return $this::where('grn_in_qty', '>', 0)->where('po_id', $poid)->count();
    }

}
