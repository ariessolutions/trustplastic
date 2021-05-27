<?php

namespace App\Models;

use App\Http\Controllers\SessionActivityController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable=['usertype','status'];

    public function getUserTypes($status=null)
    {
        return ($status == null) ? $this::all() : $this::where('status', $status)->get();
    }

    public function edit($id,$data,$activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this->where('id',$id)->update($data);
    }

    public function findFirst($id)
    {
        return $this->where('id',$id)->with('permissions')->first();
    }

    public function createUserType($data, $activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this->create($data);
    }


    public function permissions()
    {
        return $this->hasMany(Permissions::class,'usertype','id');
    }
}
