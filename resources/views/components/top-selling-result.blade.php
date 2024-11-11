@props(['chartData', 'selectedProduct', 'deskripsiProduk'])
<div x-data="{ TSChart: null }" x-init="TSChart = new Chart(document.getElementById('TSChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: {{ json_encode($chartData['labels']) }},
        datasets: [{
            label: 'Sum of {{ ucfirst(strtolower($selectedProduct)) }} Product Sold',
            data: {{ json_encode($chartData['data']) }},
            backgroundColor: [
                'rgb(101, 163, 13)',
                'rgb(152, 151, 9)',
                'rgb(202, 138, 4)',
                'rgb(210, 128, 5)',
                'rgb(217, 119, 6)',
                'rgb(225, 103, 9)',
                'rgb(234, 88, 12)',
                'rgb(227, 63, 25)',
                'rgb(220, 38, 38)',
                'rgb(185, 30, 30)'
            ],
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
                    text: 'Product Name',
                    color: '#e6b02a',
                    font: {
                        size: 16
                    }
                },
                ticks: {
                    color: '#ffff',
                    callback: function(value) {
                        const maxLabelLength = 10; // Batas panjang label
                        return value.length > maxLabelLength ? value.substring(0, maxLabelLength) + '...' : value;
                    },
                    callback: function(value, index) {
                        return index + 1; // Menampilkan index + 1 agar mulai dari 1
                    }
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
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ ucfirst(strtolower($selectedProduct)) }} Product Sales Visualization :
            </h5> <br>

            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-yellow-200">
                {{ ucfirst(strtolower($selectedProduct)) }} / {{ $deskripsiProduk->description }}
            </h5>

            {{-- Pengantar --}}
            <div class="mb-4 text-lg text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                Berikut merupakan visualisasi data top selling penjualan produk <span
                    class="font-semibold">{{ strtolower($selectedProduct) }}</span>
                :
            </div>

            {{-- Chart --}}
            <div>
                <canvas id="TSChart" width="600" height="400"></canvas>
            </div>


            {{-- Hasil Analisis --}}
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <span class="dark:text-yellow-200 font-bold">Hasil Analisis :</span> <br>
            <div class="mt-3 mb-4 text-lg dark:text-white">
                <span class="block mb-3 font-semibold">Berikut merupakan produk terlaris untuk kategori
                    {{ strtolower($selectedProduct) }} : </span>
                <div class="flex">
                    <?php
                    $counter = 1;
                    $labelData = $chartData['labels'];
                    $numberSoldData = $chartData['data'];
                    $priceData = $chartData['price'];
                    ?>
                    <div>
                        <ul>
                            @foreach ($chartData['data'] as $i => $value)
                                <li>
                                    <span class="font-semibold">{{ $counter++ . '.) ' }}</span>
                                    <span class="text-cyan-300">{{ $labelData[$i] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="ml-2">
                        <ul>
                            @foreach ($chartData['data'] as $i => $value)
                                <li>
                                    |
                                    <span class="text-cyan-300">{{ $priceData[$i] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="ml-2">
                        <ul>
                            @foreach ($chartData['data'] as $i => $value)
                                <li>
                                    => dengan
                                    <span class="text-cyan-300">{{ $numberSoldData[$i] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="ml-2">
                        <ul>
                            @foreach ($chartData['data'] as $i => $value)
                                <li>
                                    item terjual
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
