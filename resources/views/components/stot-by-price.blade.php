@props(['chartData', 'selectedProduct', 'deskripsiProduk', 'top5Price'])
<div x-data="{ sTOTChartByPrice: null }" x-init="sTOTChartByPrice = new Chart(document.getElementById('sTOTChartByPrice').getContext('2d'), {
    type: 'line',
    data: {
        labels: {{ json_encode($chartData['labels']) }},
        datasets: [{
            label: 'Sum of {{ ucfirst(strtolower($selectedProduct)) }} Product Sold',
            data: {{ json_encode($chartData['data']) }},
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Price',
                    color: '#e6b02a',
                    font: {
                        size: 16
                    }
                },
                ticks: {
                    color: '#ffff',
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Sum of {{ ucfirst(strtolower($selectedProduct)) }} Product Sold',
                    color: '#e6b02a',
                    font: {
                        size: 16
                    }
                },
                ticks: {
                    color: '#ffff',
                }
            }
        }
    }
});">
    <div>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            {{-- Pengantar --}}
            <div class="mb-4 text-lg text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                Berikut merupakan visualisasi data trend penjualan berdasarkan harga dijualnya produk <span
                    class="font-semibold">{{ strtolower($selectedProduct) }}</span>
                :
            </div>

            {{-- Chart --}}
            <div>
                <canvas id="sTOTChartByPrice" width="600" height="400"></canvas>
            </div>

            {{-- Hasil Analisis --}}
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <span class="dark:text-yellow-200 font-bold">Hasil Analisis :</span> <br>
            <div class="mt-3 mb-4 text-lg dark:text-white">
                <span class="block mb-3 font-semibold">Berikut merupakan harga penjualan paling efektif untuk produk
                    {{ strtolower($selectedProduct) }} : </span>
                <ul>
                    <?php $counter = 1; ?>
                    @foreach ($top5Price as $i)
                        <li>
                            <span class="font-semibold">{{ $counter++ . '.) ' }}</span>
                            <span class="text-cyan-300">{{ $i->formatted_price }}</span>
                            => dengan
                            <span class="text-cyan-300">{{ $i->total_items_sold }}</span>
                            produk {{ ucfirst(strtolower($selectedProduct)) }}
                            terjual
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
