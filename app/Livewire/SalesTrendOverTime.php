<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\market_basket_data;

#[Layout('components.layout')]
#[Title('MBA - Market Analysis')]
class SalesTrendOverTime extends Component
{
    public $products = [];
    public $timeRange = '';
    public $categoryProduct = '';
    public $chartData = [];

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

        // Dapatkan data sesuai filter yang dipilih
        $sales = market_basket_data::getSalesTrendOverTimeChartData(
            $this->categoryProduct,
            $this->timeRange
        );

        // Siapkan data untuk chart
        $this->chartData = [
            'labels' => $sales->pluck('date'),   // Data tanggal
            'data' => $sales->pluck('price'),    // Data harga
        ];

        // dd($this->chartData);

        // Emit event untuk memperbarui chart dengan data baru
        // $this->dispatch('refreshChart', $chartData);
        // $this->dispatch('chartDataUpdated', $chartData);
    }

    public function render()
    {
        return view('livewire.sales-trend-over-time', [
            'products' => $this->products,
            'chartData' => $this->chartData,
        ]);
    }
}
