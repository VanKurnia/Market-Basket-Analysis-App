@props(['recommendation', 'rank'])
<div x-data="{{ $recommendation['id'] }}: null" x-init="{{ $recommendation['id'] }} = new Chart(document.getElementById('{{ $recommendation['id'] }}').getContext('2d'), {
    type: 'pie',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: ['# of Confidence'],
            data: [12, 19, 3, 5, 2, 3],
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
                    <span class="text-white font-semibold">
                        Keterangan :
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
