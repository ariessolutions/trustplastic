<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRNHasItems extends Model
{
    use HasFactory;

    protected $fillable=['qty','unit_price','bin_location_id','unit_price','status','item_id','grn_id','subtotal','discount','vat'];

    public function createRecord($data)
    {
        return $this::create($data);
    }

    public function item()
    {
        return $this->hasOne(item::class,'id','item_id')->with('munit');
    }
}
