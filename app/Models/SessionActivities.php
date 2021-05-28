<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionActivities extends Model
{
    use HasFactory;

    protected $fillable=['interface','activity','userid'];
}
