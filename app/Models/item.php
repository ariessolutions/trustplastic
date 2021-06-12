<?php

namespace App\Models;

use App\Http\Controllers\SessionActivityController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    protected $fillable = ['item_code','item_part_code','item_name', 'item_category_id', 'measure_unit_id', 'status'];

    public function getAll()
    {
        return $this::orderby('status')->get();
    }

    public function getItemCount()
    {
        return $this::count();
    }

    public function add($data)
    {
        (new SessionActivityController)->createActivity(['view' => 'Item', 'activity' => 'Added']);
        return $this->create($data);
    }

    public function edit($key, $term, $data)
    {
        (new SessionActivityController)->createActivity(['view' => 'Item Updated', 'activity' => 'Updated-' . $term]);
        return $this->where($key, $term)->update($data);
    }

    public function getItemById($id)
    {
        return $this::where('id', $id)->with('munit')->first();
    }

    public function getItemByCode($code)
    {
        return $this::where('item_code', $code)->first();
    }

    public function getItemByPartCode($code)
    {
        return $this::where('item_part_code', $code)->first();
    }

    public function bins()
    {
        return $this->hasMany(bin_location::class,'item_id','id');
    }

    public function suggetions($input)
    {
        return $this::where([
            ['status', '=', 1],
            ["item_code", "LIKE", "%{$input['query']}%"],
        ])->orWhere([
            ['status', '=', 1],
            ["item_name", "LIKE", "%{$input['query']}%"],
        ])->orWhere([
            ['status','=',1],
            ['item_part_code','LIKE',"%{$input['query']}%"],
        ])->get();
    }

    public function munit()
    {
        return $this->hasOne(measure_unit::class,'id','measure_unit_id');
    }

}
