<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deskripsi_produk extends Model
{
    use HasFactory;

    public $table = 'deskripsi_produk';

    public static function getDeskripsiProduk($product_name)
    {
        return static::where('name', '=', $product_name)->first();
    }
}
