<?php

namespace App\Models;

use App\Http\Controllers\SessionActivityController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['brand', 'code', 'model', 'status'];

    public function suggetions($input)
    {
        return $this::where([
            ['status', '=', 1],
            ["model", "LIKE", "%{$input['query']}%"],
        ])->orWhere([
            ['status', '=', 1],
            ["brand", "LIKE", "%{$input['query']}%"],
        ])->get();


    }

    public function getNextId()
    {
        return DB::select("SHOW TABLE STATUS LIKE 'vehicles'")[0]->Auto_increment;
    }

    public function createVehicle($data, $activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this->create($data);
    }

    public function getVehicles($status = null)
    {
        return ($status == null) ? $this::orderBy('id','DESC')->get() : $this::where('status', $status)->orderBy('id','DESC')->get();
    }

    public function edit($id, $data, $activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this->where('id', $id)->update($data);
    }

    public function getData($id)
    {
        return $this->where('id',$id)->first();
    }
}
