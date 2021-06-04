<?php

namespace App\Http\Controllers;

use App\Models\location;

class LocationController extends Controller
{
    public function getLocations()
    {
        return (new location)->getAll();
    }
}
