<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['grn_id', 'location_id', 'status','transfer_id'];

    public function createRecord($data)
    {
        return $this::create($data);
    }

    public function getGrnStocks($grnId)
    {
        $data = [];

        foreach (Stock::where('grn_id', $grnId)->get() as $key => $value) {
            $data[] = $value->id;
        }

        return $data;
    }

    public function getTransfers($data)
    {
        $query = Transaction::where('status', 1);

        if ($data['start'] != null) {
            $query->whereDate('created_at', '>=', Carbon::parse($data['start']));
        }

        if ($data['end'] != null) {
            $query->whereDate('created_at', '<=', Carbon::parse($data['end']));
        }

        return $query->with('fromData')->with('toData')->with('userData')->orderBy('id','DESC')->get();
    }

    public function stock_items()
    {
        return $this->hasMany(StockHasItems::class, 'stock_id', 'id')->with('bindata')->with('item');
    }

    public function getLocationStocks($locationId)
    {
        $data = [];

        foreach (Stock::where('location_id', $locationId)->get() as $key => $value) {
            $data[] = $value->id;
        }

        return $data;
    }
}
