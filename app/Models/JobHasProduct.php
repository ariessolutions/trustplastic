<?php

namespace App\Models;

use App\Http\Controllers\SessionActivityController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobHasProduct extends Model
{

    protected $fillable=['job_id','bin','product','qty','cost','subtotal','vat','ex_total','nettotal','status'];

    use HasFactory;

    function add ($data) {
        return $this->create($data);
    }

    public function edit($id, $data, $activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this->where('id', $id)->update($data);
    }

    public function outsideex()
    {
        return $this->hasMany(OutsideExp::class, 'jobproduct', 'id');
    }

    public function productdata()
    {
        return $this->hasOne(Product::class,'id','product');
    }

    public function bindata()
    {
        return $this->hasOne(bin_location::class, 'id', 'bin');
    }
}
