<section class="bg-white dark:bg-gray-900 my-auto">
    <div class="py-8 px-4 mx-auto max-w-5xl lg:py-16">

        {{-- Page Heading --}}
        <h2 class="mb-4 text-3xl text-center font-bold text-gray-900 dark:text-white">
            Sales Trend <br>
            Over Time Analysis<br>
        </h2>

        {{-- Form / Chart --}}
        @if (!$deskripsi_produk)
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <x-stot-form></x-stot-form>

            {{-- Penjelasan --}}
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <h2 class="mb-3 text-lg text-center font-semibold text-gray-900 dark:text-neutral-400">
                Analisis ini membantu menemukan pola pembelian pelanggan berdasarkan tanggal pembelian, jumlah produk
                terjual, waktu pembelian, dan harga produk yang terjual. Bagian hasil akan menampilkan visualisasi dari
                trend penjualan produk yang dipilih.
            </h2>
        @else
            {{-- trend by number & date of item sold chart  --}}
            <x-stot-result :chartData="$chartData[0]" :selectedProduct="$selectedProduct" :deskripsiProduk="$deskripsiProduk" :top2DaysOfWeek="$top2DaysOfWeek"
                :top5Dates="$top5Dates"></x-stot-result>

            {{-- trend by hour of item sold chart  --}}
            <x-stot-by-hour :chartData="$chartData[1]" :selectedProduct="$selectedProduct" :deskripsiProduk="$deskripsiProduk" :top5Hour="$top5Hour"></x-stot-by-hour>

            {{-- By number of item sold chart  --}}
            <x-stot-by-price :chartData="$chartData[2]" :selectedProduct="$selectedProduct" :deskripsiProduk="$deskripsiProduk"
                :top5Price="$top5Price"></x-stot-by-price>
        @endif
    </div>
</section>
