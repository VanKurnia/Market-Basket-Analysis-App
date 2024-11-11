<section class="bg-white dark:bg-gray-900 my-auto">
    <div class="py-8 px-4 mx-auto max-w-5xl lg:py-16">

        {{-- Page Heading --}}
        <h2 class="mb-4 text-3xl text-center font-bold text-gray-900 dark:text-white">
            Top Selling <br>
            Product Analysis<br>
        </h2>

        {{-- Form / Chart --}}
        @if (!$deskripsiProduk)
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <x-top-selling-form></x-top-selling-form>
            {{-- Penjelasan --}}
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <h2 class="mb-3 text-lg text-center font-semibold text-gray-900 dark:text-neutral-400">
                Analisis ini akan membantu menemukan nama produk yang paling populer sesuai dengan kategori produk yang
                dipilih. Bagian hasil akan menampilkan visualisasi dan analisis dari top selling product.
            </h2>
        @else
            <x-top-selling-result :chartData="$chartData" :selectedProduct="$selectedProduct" :deskripsiProduk="$deskripsiProduk"></x-top-selling-result>
        @endif

    </div>
</section>
