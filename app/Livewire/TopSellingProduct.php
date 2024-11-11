<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\market_basket_data;
use App\Models\deskripsi_produk;

#[Layout('components.layout')]
#[Title('MBA - Market Analysis')]
class TopSellingProduct extends Component
{
    public $products = [];
    public $categoryProduct = '';
    public $deskripsi_produk;
    public $startDate;
    public $endDate;
    public $minPrice;
    public $maxPrice;
    public $chartData = [];

    // Inisialisasi data produk untuk dropdown pada saat mount
    public function mount()
    {
        $this->products = market_basket_data::getTypeProductData();
    }

    public function submitForm()
    {
        $this->deskripsi_produk = deskripsi_produk::getDeskripsiProduk($this->categoryProduct);

        $topSellingProduct = market_basket_data::getTopSellingProducts(
            $this->categoryProduct,
            $this->startDate,
            $this->endDate,
            str_replace('.', '', $this->minPrice),
            str_replace('.', '', $this->maxPrice),
        );

        $this->chartData = [
            'labels' => $topSellingProduct->pluck('product_name'),
            'data' => $topSellingProduct->pluck('total_sales'),
            'price' => $topSellingProduct->pluck('formatted_price'),
        ];
        // dd($this->chartData);
    }

    public function render()
    {
        return view('livewire.top-selling-product', [
            'products'          => $this->products,
            'selectedProduct'   => $this->categoryProduct,
            'deskripsiProduk'   => $this->deskripsi_produk,
        ]);
    }
}
