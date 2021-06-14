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

    public function updateRecord($id, $data)
    {
        return $this::where('id', $id)->update($data);
    }

    public function getItemStockQuantity($id,$from)
    {
        $arr=bin_location::where('status',1)->where('location_id',$from)->get('id');
        return $this::where('item_id', $id)->whereIn('bin_location_id',$arr)->sum('qty');
    }

    public function getByItemId($itemid, $qty = 0)
    {
        return $this::where('status', 1)->where('item_id', $itemid)->where('qty', '>', $qty)->orderBy('id', 'ASC')->get();
    }

    public function bindata()
    {
        return $this->hasOne(bin_location::class,'id','bin_location_id');
    }

    public function item()
    {
        return $this->hasOne(item::class,'id','item_id')->with('munit');
    }
}
