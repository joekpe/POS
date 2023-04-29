<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Supplier;
use App\Models\Product;

class Receiving extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'supplier_id',
        'product_id',
        'quantity',
        'cost'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
