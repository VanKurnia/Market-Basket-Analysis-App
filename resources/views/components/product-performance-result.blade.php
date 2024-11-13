@props(['chartData'])

<div x-data="{ productPerformanceChart: null }" x-init="productPerformanceChart = new Chart(document.getElementById('productPerformanceChart').getContext('2d'), {
    type: 'line',
    data: {{ json_encode($chartData) }},
    options: {
        responsive: true,
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Date',
                    color: '#e6b02a',
                    font: {
                        size: 16
                    }
                },
                ticks: {
                    color: '#ffff',
                },
            },
            y: {
                title: {
                    display: true,
                    text: 'Total Sales',
                    color: '#e6b02a',
                    font: {
                        size: 16
                    }
                },
                ticks: {
                    color: '#ffff',
                },
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    color: '#ffff',
                }
            }
        }
    }
});">
    {{-- <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"> --}}
    <canvas id="productPerformanceChart" width="800" height="800"></canvas>
    {{-- </div> --}}
</div>
