<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MRProductsHasItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_has_product_id',
        'material_request_id',
        'item_id',
        'qty',
        'status',
    ];

    public function add($data)
    {
        return $this->create($data);
    }

    public function getjobHasProducts()
    {
        return $this->hasOne(Product::class, 'id', 'job_has_product_id');
    }

    public function getItemById()
    {
        return $this->hasOne(Item::class, 'id' , 'item_id');
    }

}
