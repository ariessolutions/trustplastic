<?php

namespace App\Models;

use App\Http\Controllers\SessionActivityController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_code',
        'supplier_name',
        'supplier_primary_tel',
        'supplier_secondary_tel',
        'supplier_address',
        'supplier_payment_details',
        'supplier_remark',
        'status',
    ];

    public function getAll()
    {
        return $this::orderby('status')->get();
    }

    public function getSupplierbyId($value)
    {
        return $this::where('id',$value)->first();
    }

    public function getSupplierCount()
    {
        return $this::count();
    }

    public function add($data)
    {
        (new SessionActivityController)->createActivity(['view' => 'Supplier', 'activity' => 'Added']);
        return $this->create($data);
    }

    public function edit($key, $term, $data)
    {
        (new SessionActivityController)->createActivity(['view' => 'Supplier Updated', 'activity' => 'Updated-' . $term]);
        return $this->where($key, $term)->update($data);
    }

    public function activeStatus($key, $status)
    {
        (new SessionActivityController)->createActivity(['view' => 'Supplier Status Updated', 'activity' => 'Updated-' . $status]);
        return $this->where('id', $key)->update(array('status'=>$status));
    }

    public function getSupplierByCode($code){
        return $this::where('supplier_code',$code)->first();
    }



}
