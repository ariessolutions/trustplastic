<?php

namespace App\Models;

use App\Http\Controllers\SessionActivityController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle', 'code', 'name', 'status'];

    public function getNextId()
    {
        return DB::select("SHOW TABLE STATUS LIKE 'products'")[0]->Auto_increment;
    }

    public function createProduct($data, $activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this->create($data);
    }

    public function getAll($status = null)
    {
        return ($status == null) ? $this::all() : $this::where('status', $status)->with('vehicles')->get();
    }

    public function edit($id, $data, $activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this->where('id', $id)->update($data);
    }

    public function getData($id)
    {
        return $this->where('id', $id)->first();
    }

    public function vehicles()
    {
        return $this->hasOne(Vehicle::class,'id','vehicle');
    }
}
