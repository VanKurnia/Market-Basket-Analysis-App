@props(['chartData'])

<div x-data="{ sTOTChart: null }" x-init="sTOTChart = new Chart(document.getElementById('sTOTChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: {{ json_encode($chartData['labels']) }},
        datasets: [{
            label: 'Sales Price Over Time',
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
                    text: 'Date'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Price'
                }
            }
        }
    }
});">

    {{-- Chart --}}
    <div>
        <canvas id="sTOTChart" width="600" height="400"></canvas>
    </div>
</div>
