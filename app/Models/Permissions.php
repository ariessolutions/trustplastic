<?php

namespace App\Models;

use App\Http\Controllers\SessionActivityController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Permissions extends Model
{
    use HasFactory;

    protected $fillable = ['route', 'usertype'];

    public function getPermissions($usertype)
    {
        return $this::where('usertype', $usertype)->get();
    }

    public function isValid($route)
    {
        $route = (new Route)->getViaRoute($route);

        $isPermitted = false;
        if(Auth::user()->status==1){
            if (UserType::where('status', 1)->where('id', Auth::user()->usertype)->first()) {
                if ($route) {
                    $isPermitted = $this->where('usertype', Auth::user()->usertype)->where('route', $route->id)->first();

                    if ($isPermitted) {
                        Session::put('view', $route->name);

                        $isPermitted = true;
                    } else {
                        $isPermitted = false;
                    }
                }
            }
        }

        return $isPermitted;
    }

    public function route()
    {
        return $this->hasMany(Route::class, 'id', 'route');
    }

    public function createPermission($data, $activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this->create($data);
    }

    public function removeRecords($usertype,$activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this::where('usertype',$usertype)->delete();
    }
}
