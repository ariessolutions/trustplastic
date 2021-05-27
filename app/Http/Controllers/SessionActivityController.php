<?php

namespace App\Http\Controllers;

use App\Models\SessionActivities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionActivityController extends Controller
{
    public function createActivity($activity)
    {
       SessionActivities::create([
           'interface'=>$activity['view'],
           'activity'=>$activity['activity'],
           'userid'=>Auth::user()->id,
       ]);
    }
}
