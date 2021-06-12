<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutsideExp extends Model
{
    use HasFactory;

    protected $fillable=['jobproduct','expense','reference','amount','remark','status'];

    function add ($data) {
        return $this->create($data);
    }
}
