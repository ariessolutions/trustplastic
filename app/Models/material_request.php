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

    public function getMrCount()
    {
        return $this::count();
    }

    public function getProductsOfJobByJobId($id)
    {
        return (new JobHasProduct)->where('status', 1)->where('job_id', $id)->get();
    }

    public function add($data)
    {
        return $this->create($data);
    }

}
