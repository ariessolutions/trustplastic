<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;

    public function getActiveAll()
    {
        return $this::where('status', 1)->get();
    }

    public function getLocationbyId($value)
    {
        return $this::where('id',$value)->first();
    }

    public function getAll($status = null)
    {
        return ($status == null) ? $this::all() : $this::where('status', $status)->with('vehicles')->get();
    }

    public function binlocations()
    {
        return $this->hasMany(bin_location::class, 'id', 'location_id');
    }

}
