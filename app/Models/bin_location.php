<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bin_location extends Model
{
    use HasFactory;

    public function getBinLocationByCode($code)
    {
        return $this::where('bin_location_name', $code)->first();
    }

}
