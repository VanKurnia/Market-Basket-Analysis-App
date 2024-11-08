<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\deskripsi_produk;
use App\Models\market_basket_data;

#[Layout('components.layout')]
#[Title('MBA - Market Analysis')]
class SalesTrendOverTime extends Component
{
    public $products = [];
    public $categoryProduct = '';
    public $chartData = [];
    public $deskripsi_produk;
    public $top5Dates;
    public $top5Hour;
    public $top5Price;
    public $top2DaysOfWeek;
    public $startDate;
    public $endDate;

    // Atur validasi untuk properti
    protected $rules = [
        'categoryProduct' => 'required',
    ];

    // Inisialisasi data produk untuk dropdown pada saat mount
    public function mount()
    {
        $this->products = market_basket_data::getTypeProductData();
    }

    // Method untuk submit form
    public function submitForm()
    {
        // Validasi input form
        $this->validate([
            'categoryProduct' => 'required'
        ]);

        $this->deskripsi_produk = deskripsi_produk::getDeskripsiProduk($this->categoryProduct);

        // Dapatkan data sesuai filter yang dipilih
        $salesData = market_basket_data::getSalesTrendOverTimeChartData(
            $this->categoryProduct,
            $this->startDate,
            $this->endDate,
        );

        $salesData2 = market_basket_data::getSalesTrendByHourChartData(
            $this->categoryProduct,
            $this->startDate,
            $this->endDate,
        );

        $salesData3 = market_basket_data::getSalesTrendByPriceChartData(
            $this->categoryProduct,
            $this->startDate,
            $this->endDate,
        );

        // dd($salesData3);

        /* === CHART 1 === */
        // 1. Menampilkan 5 tanggal dengan penjualan terbanyak
        $this->top5Dates = $salesData->sortByDesc('total_items_sold')->take(5);

        // 2. Menghitung total item terjual berdasarkan hari dalam seminggu
        $dayOfWeekSales = $salesData->groupBy(function ($item) {
            return Carbon::parse($item->sale_date)->dayOfWeek; // 0 untuk Minggu, 1 untuk Senin, dst.
        })->map(function ($group) {
            return $group->sum('total_items_sold');
        });

        // Mengambil 2 hari dengan penjualan terbanyak
        $top2DaysOfWeek = $dayOfWeekSales->sortDesc()->take(2);

        // Mendapatkan nama hari dan rata-rata penjualan untuk dua hari tersebut
        $this->top2DaysOfWeek = $top2DaysOfWeek->mapWithKeys(function ($totalSales, $dayOfWeek) {
            $dayName = Carbon::create()->dayOfWeek($dayOfWeek)->locale('id')->dayName;
            $averageSales = $totalSales / $this->getDaysCountInRange($dayOfWeek);
            return [$dayName => $averageSales];
        });

        // Siapkan data untuk chart 1
        $this->chartData[0] = [
            'labels' => $salesData->pluck('sale_date'),   // Data tanggal pembelian
            'data' => $salesData->pluck('total_items_sold'),    // Data jumlah penjualan
        ];

        /* === CHART 2 === */
        // 1. Menampilkan 5 jam dengan penjualan terbanyak
        $this->top5Hour = $salesData2->sortByDesc('total_items_sold')->take(5);

        // Siapkan data untuk chart 2
        $this->chartData[1] = [
            'labels' => $salesData2->pluck('formatted_hour'),   // Data jam pembelian
            'data' => $salesData2->pluck('total_items_sold'),    // Data jumlah penjualan
        ];

        /* === CHART 3 === */
        // 1. Menampilkan 5 harga dengan penjualan terbanyak
        $this->top5Price = $salesData3->sortByDesc('total_items_sold')->take(5);

        // Siapkan data untuk chart 3
        $this->chartData[2] = [
            'labels' => $salesData3->pluck('formatted_price'),   // Data harga jual item
            'data' => $salesData3->pluck('total_items_sold'),    // Data jumlah penjualan
        ];

        // dd($this->chartData[2]);
    }

    public function render()
    {
        return view('livewire.sales-trend-over-time', [
            'products'          => $this->products,
            'chartData'         => $this->chartData,
            'selectedProduct'   => $this->categoryProduct,
            'deskripsiProduk'   => $this->deskripsi_produk,
            'top2DaysOfWeek'    => $this->top2DaysOfWeek,
            'top5Dates'         => $this->top5Dates,
            'top5Hour'          => $this->top5Hour,
            'top5Price'         => $this->top5Price,
        ]);
    }

    /* HELPER */
    // Helper function untuk menghitung jumlah hari tertentu dalam jangka waktu yang diberikan
    protected function getDaysCountInRange($dayOfWeek)
    {
        $startDate = Carbon::parse($this->startDate ?? 'first day of January this year');
        $endDate = Carbon::parse($this->endDate ?? 'today');
        $count = 0;

        // Mengiterasi dari tanggal mulai hingga akhir untuk menghitung jumlah hari tertentu
        while ($startDate->lte($endDate)) {
            if ($startDate->dayOfWeek === $dayOfWeek) {
                $count++;
            }
            $startDate->addDay();
        }

        return $count > 0 ? $count : 1; // Menghindari pembagian dengan nol
    }
}
