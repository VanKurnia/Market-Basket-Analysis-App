<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\market_basket_data;

#[Layout('components.layout')]
#[Title('MBA - Market Analysis')]
class ProductPerformance extends Component
{
    public $startDate;
    public $endDate;
    public $chartData;

    public function mount()
    {
        $this->startDate = null;
        $this->endDate = null;
        $this->loadSalesData();
    }

    public function loadSalesData()
    {
        $salesData = market_basket_data::getProductPerformanceChartData($this->startDate, $this->endDate);

        $dataByCategory = [];
        foreach ($salesData as $sale) {
            $dataByCategory[$sale->category][] = [
                'date' => $sale->sale_date,
                'total_sales' => $sale->total_sales
            ];
        }

        $chartData = [
            'labels' => $salesData->pluck('sale_date')->unique()->values(),
            'datasets' => []
        ];

        foreach ($dataByCategory as $category => $sales) {
            $color = $this->generateRandomColor();
            $dataset = [
                'label' => $category,
                'data' => [],
                'backgroundColor' => $color,
                'borderColor' => $color,
                'fill' => false
            ];

            foreach ($chartData['labels'] as $date) {
                $totalSalesOnDate = collect($sales)->firstWhere('date', $date)['total_sales'] ?? 0;
                $dataset['data'][] = $totalSalesOnDate;
            }

            $chartData['datasets'][] = $dataset;
        }

        $this->chartData = $chartData;
        dd($chartData);
    }

    public function render()
    {
        return view('livewire.product-performance', [
            'chartData' => $this->chartData,
        ]);
    }

    // helper
    private function generateRandomColor()
    {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        $a = 1; // Transparansi

        return "rgba($r, $g, $b, $a)";
    }
}
