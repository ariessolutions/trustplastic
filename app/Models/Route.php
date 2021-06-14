<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    public function getViaRoute($route)
    {
        return $this::where('route',$route)->first();
    }

    public function getAll()
    {
        return $this->orderBy('id','DESC')->get();
    }
}
