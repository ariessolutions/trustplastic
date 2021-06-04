<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable=['grn_id','location_id','status'];

    public function createRecord($data)
    {
        return $this::create($data);
    }

    public function getGrnStocks($grnId)
    {
        $data=[];

        foreach (Stock::where('grn_id',$grnId)->get() as $key => $value) {
            $data[]=$value->id;
        }

        return $data;
    }
}