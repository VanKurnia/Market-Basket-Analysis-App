@props(['topRecommendations', 'selectedProduct', 'productDesc'])
<div x-data="{ recommendationChart: null }" x-init="recommendationChart = new Chart(document.getElementById('RecommendationChart').getContext('2d'), {
    type: 'bar',
    data: {
        {{-- labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'], --}}
        labels: [
            <?php $max = count($topRecommendations);
            for ($i = 0; $i < $max; $i++) {
                $label = $topRecommendations[$i];
                // Memisahkan label menjadi beberapa baris jika lebih dari 2 kata
                $labelWords = explode(' ', $label['consequent']);
                if (count($labelWords) > 1) {
                    $labelWithLineBreak = "['" . implode("', '", array_slice($labelWords, 0, 2)) . "', '" . implode(" ', '", array_slice($labelWords, 2)) . "']";
                    echo $labelWithLineBreak . ',';
                } else {
                    echo "'" . $label['consequent'] . "',";
                }
            } ?>
        ],
        datasets: [{
            {{-- data: [12, 19, 3, 5, 2, 3], --}}
            data: [
                <?php $max = count($topRecommendations);
                for ($i = 0; $i < $max; $i++) {
                    $label = $topRecommendations[$i];
                    echo "'" . $label['confidence'] . "'" . ',';
                } ?>
            ],
            borderWidth: 1,
            borderColor: '#ffff',
            backgroundColor: [
                'rgb(101, 163, 13)',
                'rgb(202, 138, 4)',
                'rgb(217, 119, 6)',
                'rgb(234, 88, 12)',
                'rgb(220, 38, 38)'
            ],
        }]
    },
    options: {
        indexAxis: 'y',
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#ffff', // Font color for y-axis labels
                    font: {
                        size: 14 // Change font size here for y-axis
                    },
                    align: 'left', // Align label text to the left
                    padding: 10 // Optional: Adds padding to create space between labels and axis
                }
            },
            x: {
                ticks: {
                    color: '#ffff', // Font color for x-axis labels
                    font: {
                        size: 14 // Change font size here for y-axis
                    }
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: false
            }
        }
    }
});">
    <div>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ ucfirst(strtolower($selectedProduct)) }} Product Analysis :
            </h5>

            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-yellow-200">
                {{ ucfirst(strtolower($selectedProduct)) }} / {{ $productDesc->description }}
            </h5>

            {{-- Pengantar --}}
            <div class="mb-4 text-lg text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                Berdasar analisis data pola pembelian konsumen menggunakan algoritma apriori, berikut merupakan produk
                yang sering dibeli bersamaan dengan <span class="font-semibold">{{ strtolower($selectedProduct) }}</span>
                :
            </div>

            {{-- Chart --}}
            <div>
                <canvas id="RecommendationChart" width="600" height="400"> </canvas>
            </div>

            {{-- Interpretasi --}}
            @php $mostRecommendProduct = $topRecommendations[0]; @endphp
            <div class="mt-3 mb-4 text-lg text-green-800 bg-green-50 dark:bg-gray-800 dark:text-cyan-300"
                role="alert">
                Produk yang paling direkomendasikan dengan
                <span class="font-semibold">{{ strtolower($selectedProduct) }}
                    adalah {{ strtolower($mostRecommendProduct['consequent']) }}
                </span> dimana terdapat
                {{ round($mostRecommendProduct['confidence'] * 100, 2) }}% kemungkinan konsumen akan membeli
                {{ strtolower($mostRecommendProduct['consequent']) }} ketika sudah memasukkan
                {{ strtolower($selectedProduct) }} dalam keranjang belanja.
            </div>
        </div>
    </div>
</div>
