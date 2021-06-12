<?php

namespace App\Models;

use App\Http\Controllers\SessionActivityController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle', 'location', 'user', 'code', 'mcode', 'cost', 'remark', 'approval_date', 'approval_user'];

    public function getNextId()
    {
        return DB::select("SHOW TABLE STATUS LIKE 'jobs'")[0]->Auto_increment;
    }

    function add ($data, $activity) {
        (new SessionActivityController)->createActivity($activity);
        return $this->create($data);
    }

    public function edit($id, $data, $activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this->where('id', $id)->update($data);
    }

    public function getAll()
    {
        return $this->with('locationdata')->with('vehicleData')->get();
    }

    public function getRecord($id)
    {
        return $this->where('id',$id)->with('locationdata')->with('vehicleData')->with('jobhasproducts')->with('approved_user_data')->first();
    }

    public function locationdata()
    {
        return $this->hasOne(location::class, 'id', 'location');
    }

    public function approved_user_data()
    {
        return $this->hasOne(User::class, 'id', 'approval_user');
    }

    public function jobhasproducts()
    {
        return $this->hasMany(JobHasProduct::class, 'job_id', 'id')->with('productdata')->with('bindata')->with('outsideex');
    }

    public function vehicleData()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle');
    }
}
