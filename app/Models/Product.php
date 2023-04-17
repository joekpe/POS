<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'category',
        'supplier_id',
        'wholesale_price',
        'retail_price',
        'quantity_stock',
        'receiving_quantity',
        'reorder_level',
        'description',
        'avatar'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
