<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bin_location extends Model
{
    use HasFactory;

    public function getBinLocationById($id)
    {
        return $this::where('id', $id)->first();
    }

    public function getBinLocationByCode($code)
    {
        return $this::where('bin_location_name', $code)->first();
    }

    public function getLocationBins($lid)
    {
        return $this::where('location_id', $lid)->where('status',1)->get();
    }

}
