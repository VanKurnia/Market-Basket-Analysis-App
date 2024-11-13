<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    // Fungsi untuk mendapatkan total item terjual berdasarkan kategori dan jangka waktu (opsional)
    public static function getSalesTrendOverTimeChartData($category, $startDate = null, $endDate = null)
    {
        return self::selectRaw('DATE(date) as sale_date, SUM(quantity) as total_items_sold')
            ->where('category', $category)
            ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
                // Tambahkan kondisi rentang tanggal
                $query->whereBetween('date', [$startDate, $endDate]);
            })
            ->groupBy('sale_date')
            ->orderBy('sale_date', 'ASC')
            ->get();
    }

    // Fungsi untuk mendapatkan total item terjual berdasarkan jam pembelian dan jangka waktu (opsional)
    public static function getSalesTrendByHourChartData($category, $startDate = null, $endDate = null)
    {
        $data = self::selectRaw('hour, SUM(quantity) as total_items_sold')
            ->where('category', $category)
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            })
            ->groupBy('hour')
            ->orderBy('hour', 'ASC')
            ->get();

        // Format hour to 'HH:00'
        return $data->map(function ($item) {
            $item->formatted_hour = str_pad($item->hour, 2, '0', STR_PAD_LEFT) . ':00';
            return $item;
        });
    }

    // Fungsi untuk mendapatkan total item terjual berdasarkan harga pembelian dan jangka waktu (opsional)
    public static function getSalesTrendByPriceChartData($category, $startDate = null, $endDate = null)
    {
        $results = self::selectRaw('price, SUM(quantity) as total_items_sold')
            ->where('category', $category)
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            })
            ->groupBy('price')
            ->orderBy('price', 'ASC')
            ->get();

        // Format harga ke dalam Rupiah
        $results->transform(function ($item) {
            $item->formatted_price = 'Rp ' . number_format($item->price, 0, ',', '.');
            return $item;
        });

        return $results;
    }

    // Top Selling Product
    public static function getTopSellingProducts($category, $startDate = null, $endDate = null, $minPrice = null, $maxPrice = null)
    {
        $results = self::select('product_name', 'price', DB::raw('SUM(quantity) as total_sales'))
            ->where('category', $category)
            ->when($startDate, function ($query) use ($startDate) {
                $query->where('date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->where('date', '<=', $endDate);
            })
            ->when($minPrice, function ($query) use ($minPrice) {
                $query->where('price', '>=', $minPrice);
            })
            ->when($maxPrice, function ($query) use ($maxPrice) {
                $query->where('price', '<=', $maxPrice);
            })
            ->groupBy('product_name', 'price')
            ->orderByDesc('total_sales')
            ->take(10)
            ->get();

        $results->transform(function ($item) {
            $item->formatted_price = 'Rp ' . number_format($item->price, 0, ',', '.');
            return $item;
        });

        return $results;
    }

    // product performance chart data
    public static function getProductPerformanceChartData($startDate = null, $endDate = null)
    {
        $salesData = self::selectRaw('DATE(date) as sale_date, category, SUM(quantity) as total_sales')
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('date', '>=', Carbon::parse($startDate));
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('date', '<=', Carbon::parse($endDate));
            })
            ->groupBy('sale_date', 'category')
            ->orderBy('sale_date')
            ->get();

        return $salesData;
    }
}
