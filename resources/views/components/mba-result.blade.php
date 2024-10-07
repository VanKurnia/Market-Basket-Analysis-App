@props(['topRecommendations', 'selectedProduct'])
<div x-data="{ recommendationChart: null }" x-init="recommendationChart = new Chart(document.getElementById('RecommendationChart').getContext('2d'), {
    type: 'bar',
    data: {
        {{-- labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'], --}}
        labels: [
            <?php $max = count($topRecommendations);
            for ($i = 0; $i < $max; $i++) {
                $label = $topRecommendations[$i];
                echo "'" . $label['consequent'] . "'" . ',';
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
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
        }]
    },
    options: {
        indexAxis: 'y',
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#ffff' // Font color for y-axis labels
                }
            },
            x: {
                ticks: {
                    color: '#ffff' // Font color for x-axis labels
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

            <div class="mb-4 text-lg text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                Berdasar analisis data pola pembelian konsumen menggunakan algoritma apriori, berikut merupakan produk
                yang sering dibeli bersamaan dengan <span class="font-semibold">{{ strtolower($selectedProduct) }}</span>
                :
            </div>

            {{-- Chart --}}
            <div>
                <canvas id="RecommendationChart" width="600" height="400"> </canvas>
            </div>
        </div>
    </div>
</div>
