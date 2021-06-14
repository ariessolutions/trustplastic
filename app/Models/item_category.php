<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\SessionActivityController;

class item_category extends Model
{
    use HasFactory;

    protected $fillable=['item_category_code','item_category_name','status'];

    public function getAll(){
        return $this::orderby('status')->orderBy('id','DESC')->get();
    }

    public function getActiveAll(){
        return $this::where('status',1)->get();
    }

    public function getItemCount(){
        return $this::count();
    }

    public function add($data)
    {
        (new SessionActivityController)->createActivity(['view' => 'Item Categories', 'activity' => 'Added']);
        return $this->create($data);
    }

    public function edit($key,$term,$data)
    {
        (new SessionActivityController)->createActivity(['view' => 'Item Category Updated', 'activity' => 'Updated-'.$term]);
        return $this->where($key,$term)->update($data);
    }

}
