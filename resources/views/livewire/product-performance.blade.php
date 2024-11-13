<section class="bg-white dark:bg-gray-900 my-auto">
    <div class="py-8 px-4 mx-auto max-w-5xl lg:py-16">
        {{-- Page Heading --}}
        <h2 class="mb-4 text-3xl text-center font-bold text-gray-900 dark:text-white">
            Market Basket Analysis for Retail Store<br>
            Using Apriori Algorithm<br>
        </h2>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

        {{-- Chart Container --}}

        <x-product-performance-result :chartData="$chartData"></x-product-performance-result>

        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
        <h2 class="mb-3 text-lg text-center font-semibold text-gray-900 dark:text-neutral-400">
            Analisis ini menampilkan performa seluruh kategori produk secara keseluruhan. Pengguna dapat lebih mudah
            memahami performa produk dengan visualisasi data dalam bentuk time-series.
        </h2>
    </div>
</section>
