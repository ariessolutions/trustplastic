<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class measure_unit extends Model
{
    use HasFactory;

    public function getActiveAll(){

        return $this::where('status',1)->get();

    }

}