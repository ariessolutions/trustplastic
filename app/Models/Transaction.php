<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable=['code','user','from','to','remark'];

    public function getNextId()
    {
        return DB::select("SHOW TABLE STATUS LIKE 'transactions'")[0]->Auto_increment;
    }

    public function createRecord($data)
    {
        $data['user']=Auth::user()->id;
        return $this::create($data);
    }

    public function fromData()
    {
        return $this->hasOne(location::class,'id','from');
    }

    public function userData()
    {
        return $this->hasOne(User::class,'id','user');
    }

    public function toData()
    {
        return $this->hasOne(location::class,'id','to');
    }

    public function getData($tid)
    {
        return $this::where('id',$tid)->with('stock')->with('fromData')->with('toData')->first();
    }

    public function stock()
    {
        return $this->hasOne(Stock::class,'transfer_id','id')->with('stock_items');
    }
}
