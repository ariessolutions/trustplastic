<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockHasItems extends Model
{
    use HasFactory;

    protected $fillable=['stock_id','item_id','bin_location_id','qty','unit_price','status'];

    public function createRecord($data)
    {
        return $this::create($data);
    }
}
