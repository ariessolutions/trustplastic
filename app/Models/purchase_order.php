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

    public function supplier()
    {
        return $this->hasOne(supplier::class,'id','supplier_id');
    }

    public function getPOByCode($term)
    {
        return $this::where('status',1)->where('po_code',$term)->with('bin')->with('poitems')->first();
    }

    public function bin()
    {
        return $this->hasOne(bin_location::class,'id','bin_location_id');
    }

    public function getPoCount()
    {
        return $this::count();
    }

    public function getAll()
    {
        return $this::orderby('id','DESC')->get();
    }

    public function add($data)
    {
        // (new PurchaseOrderController)->createActivity(['view' => 'Purchase Order Added', 'activity' => 'Added']);
        return $this->create($data);
    }

    public function getPObyId($value)
    {
        return $this::where('id',$value)->first();
    }

    public function fetchedByCode($code)
    {
        return $this->where('po_code',$code)->with('poitems')->first();
    }

    public function updateRecord($id,$data)
    {
        $this->where('id',$id)->update($data);
    }

    public function poitems()
    {
        return $this->hasMany(po_has_items::class,'po_id','id')->with('bindata')->with('item');
    }


    public function updateRecordWithCheckStatus($id)
    {
        if((new po_has_items)->getNonGRNZeros($id)==0){
            $this->updateRecord($id,['status'=>4]);
        }else{
            $this->updateRecord($id,['status'=>1]);
        }
    }

    public function getPOByID2($id)
    {
        return $this::where('status',1)->where('id',$id)->with('poitems')->first();
    }

    public function printReport($id){
        return $this::where('id',$id)->with('poitems')->with('location')->with('supplier')->first();
    }

    public function location()
    {
        return $this->hasOne(location::class, 'id', 'location_id');
    }
}
