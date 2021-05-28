<?php

namespace App\Models;

use App\Http\Controllers\SessionActivityController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'emp_no',
        'usertype',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function createUser($data, $activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this->create($data);
    }

    public function getUsers($status = null)
    {
        return ($status == null) ? $this::all() : $this::where('status', $status)->get();
    }

    public function edit($id,$data,$activity)
    {
        (new SessionActivityController)->createActivity($activity);
        return $this->where('id',$id)->update($data);
    }

    public function getData($id)
    {
        return $this->where('id',$id)->first();
    }
}
