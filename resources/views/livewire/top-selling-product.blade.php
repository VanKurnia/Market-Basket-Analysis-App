<section class="bg-white dark:bg-gray-900 my-auto">
    <div class="py-8 px-4 mx-auto max-w-5xl lg:py-16">

        {{-- Page Heading --}}
        <h2 class="mb-4 text-3xl text-center font-bold text-gray-900 dark:text-white">
            Retail Store 👁️👅👁️<br>
            Top Selling Product Analysis<br>
            📈 📊 📆 💸
        </h2>

        {{-- Chart & Filter --}}
        <div class="p-6 mb-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            {{-- Filter --}}


            {{-- CHART --}}
            {{-- <canvas id="myChart"></canvas> --}}
        </div>

        {{-- Analysis Result --}}
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-white text-center text-2xl">
                🚧🚧🚧 WIP 🚧🚧🚧
            </h2>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</section>
