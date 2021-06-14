<?php

namespace App\Models;

use App\Http\Controllers\SessionActivityController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStockHasProducts extends Model
{
    use HasFactory;

    protected $fillable=['productstock','product','bin','qty','nettotal','status'];

    public function addRecord($data, $activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this->create($data);
    }
}
