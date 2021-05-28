<?php

namespace App\Models;

use App\Http\Controllers\PurchaseOrderController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class po_has_items extends Model
{
    use HasFactory;

    protected $fillable = [

        'po_id',
        'item_id',
        'qty',
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

}
