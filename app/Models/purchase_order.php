<?php

namespace App\Models;

use App\Http\Controllers\PurchaseOrderController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase_order extends Model
{
    use HasFactory;

    protected $fillable = [

        'po_code',
        'supplier_id',
        'location_id',
        'bin_location_id',
        'approved_quotation_code',
        'po_date',
        'po_expected_deliver_date',
        'po_tot',
        'discount',
        'tot_vat',
        'po_net_tot',
        'po_approved_person',
        'po_approved_date',
        'remark',
        'status',

    ];

    public function getPoCount()
    {
        return $this::count();
    }

    public function add($data)
    {
        // (new PurchaseOrderController)->createActivity(['view' => 'Purchase Order Added', 'activity' => 'Added']);
        return $this->create($data);
    }

}
