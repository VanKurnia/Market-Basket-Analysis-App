@props(['recommendation', 'rank', 'topSelling', 'productDesc'])
<div x-data="{{ $recommendation['id'] }}: null" x-init="{{ $recommendation['id'] }} = new Chart(document.getElementById('{{ $recommendation['id'] }}').getContext('2d'), {
    type: 'doughnut',
    data: {
        {{-- labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'], --}}
        labels: [
            <?php $max = count($topSelling);
            for ($i = 0; $i < $max; $i++) {
                $label = $topSelling[$i];
                echo "'" . $label->product_name . "'" . ',';
            } ?>
        ],
        datasets: [{
            label: ['# of Confidence'],
            {{-- data: [12, 19, 3, 5, 2, 3], --}}
            data: [
                <?php $max = count($topSelling);
                for ($i = 0; $i < $max; $i++) {
                    $label = $topSelling[$i];
                    echo "'" . $label->total_sales . "'" . ',';
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
                {{ $rank }}. {{ $recommendation['consequent'] }}
            </h5>

            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-yellow-200">
                {{ ucfirst(strtolower($recommendation['consequent'])) }} / {{ $productDesc[$rank]->description }}
            </h5>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Berikut merupakan top selling produk dengan kategori {{ strtolower($recommendation['consequent']) }} :
            </p>

            {{-- Chart --}}
            <div class="mt-4 grid grid-cols-6 gap-4">
                <div class="col-span-3">
                    <canvas id="{{ $recommendation['id'] }}" width="600" height="400">
                    </canvas>
                </div>
                <div class="col-span-3">
                    <span class="text-white font-semibold mb-4">
                        Keterangan :
                    </span>
                    @foreach ($topSelling as $salesNumber)
                        <h2 class="text-white font-semibold">
                            - {{ $salesNumber->product_name }} = {{ $salesNumber->total_sales }}
                        </h2>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
