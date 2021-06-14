<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material_request extends Model
{
    use HasFactory;

    protected $fillable = [
        'mr_code',
        'job_id',
        'date',
        'status',
    ];

    public function add($data)
    {
        return $this->create($data);
    }

    public function getMrCount()
    {
        return $this::count();
    }

    public function getAll()
    {
        return $this::orderby('job_id')->get();
    }

    public function getProductsOfJobByJobId($id)
    {
        return (new JobHasProduct)->where('status', 1)->where('job_id', $id)->get();
    }

    public function getJobs()
    {
        return $this->hasOne(Job::class, 'id', 'job_id')->with('locationdata')->with('vehicleData');
    }

    public function getAllMaterials()
    {
        return $this->hasMany(MRProductsHasItem::class, 'material_request_id', 'id')->with('getItemById')->with('getjobHasProducts');
    }

    public function getMaterialRequestById($id)
    {
        return $this::where('id', $id)->with('getJobs')->with('getAllMaterials');
    }


}
