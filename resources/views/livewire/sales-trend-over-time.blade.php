<section class="bg-white dark:bg-gray-900 my-auto">
    <div class="py-8 px-4 mx-auto max-w-5xl lg:py-16">

        {{-- Page Heading --}}
        <h2 class="mb-4 text-3xl text-center font-bold text-gray-900 dark:text-white">
            Sales Trend <br>
            Over Time <br>
        </h2>

        {{-- Form / Chart --}}
        @if (!$categoryProduct)
            <x-stot-form></x-stot-form>
        @else
            {{-- Chart Canvas --}}
            <x-stot-result :chartData="$chartData"></x-stot-result>

            <?php
            // print_r($chartData['labels']);
            ?>
        @endif
    </div>
</section>

<script>
    document.addEventListener('livewire:load', () => {
        let salesTrendChart;

        Livewire.on('chartDataUpdated', (chartData) => {
            const ctx = document.getElementById('salesTrendChart').getContext('2d');

            // Destroy the existing chart instance if it exists
            if (salesTrendChart) {
                salesTrendChart.destroy();
            }

            // Initialize a new Chart.js instance
            salesTrendChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Sales Price Over Time',
                        data: chartData.data,
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
            });
        });
    });
</script>
