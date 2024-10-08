<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class market_basket_data extends Model
{
    use HasFactory;

    public $table = 'market_basket_data';

    // mengambil data type_product
    public static function getTypeProductData()
    {
        $data = static::select('category', static::raw('COUNT(*) as frequency'))
            ->groupBy('category')
            ->orderBy('frequency', 'desc')
            ->get()->toArray();

        return array_slice($data, 0, 25);
    }

    // mengambil data transaksi dengan product type > 1 dalam bentuk array
    public static function getTransactionsData()
    {
        $transactionsCollection = static::select('receive_no', static::raw('GROUP_CONCAT(category) as products'))
            ->groupBy('receive_no')
            ->havingRaw('COUNT(category) > 1')
            ->get();

        $transactions = [];

        foreach ($transactionsCollection as $transaction) {
            // Memisahkan produk yang digabung dengan koma menjadi array produk
            $products = explode(',', $transaction->products);
            // Menambahkan array produk ke array transaksi
            $transactions[] = array_map('trim', $products); // Trimming untuk menghapus spasi yang tidak perlu
        }

        return $transactions;
    }

    // mencari data top selling tiap product name
    public static  function getTopSellingCategory($productName)
    {
        $topSelling = static::select('product_name', static::raw('SUM(quantity) as total_sales'))
            ->where('category', '=', $productName)
            ->groupBy('product_name')
            ->orderBy('total_sales', 'DESC')
            ->take(5)
            ->get();

        return $topSelling;
    }
}
