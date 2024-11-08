<section class="bg-white dark:bg-gray-900 my-auto">
    <div class="py-8 px-4 mx-auto max-w-5xl lg:py-16">

        {{-- Page Heading --}}
        <h2 class="mb-4 text-3xl text-center font-bold text-gray-900 dark:text-white">
            Market Basket Analysis for Retail Store<br>
            Using Apriori Algorithm<br>
        </h2>

        @if ($topRecommendations == [])
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            {{-- Form --}}
            <x-mba-form></x-mba-form>

            @if ($resultStatus == 'none')
                <h2 class="mt-3 mb-2 text-lg text-left font-semibold text-gray-900 dark:text-orange-500">
                    Kami tidak dapat menampilkan rekomendasi produk yang relevan saat ini. Hal ini dapat disebabkan oleh
                    beberapa faktor berikut: <br>
                    - Terdapat variasi yang besar dalam jenis produk atau kategori yang dianalisis <br>
                    - Produk tidak memenuhi syarat untuk menghasilkan aturan asosiasi yang valid <br>
                    - Support dan Confidence Terlalu Rendah <br>
                </h2>
            @endif

            {{-- Penjelasan --}}
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <h2 class="mb-3 text-lg text-center font-semibold text-gray-900 dark:text-neutral-400">
                Analisis ini membantu menemukan pola pembelian pelanggan serta rekomendasi produk
                yang sering dibeli bersamaan. Bagian hasil akan menampilkan rekomendasi produk beserta daftar produk
                terlaris, memberi Anda gambaran tentang performa produk dan peluang bundling.
            </h2>
        @else
            {{-- Result --}}
            <x-mba-result :topRecommendations="$topRecommendations" :selectedProduct="$selectedProduct" :productDesc="$productDesc[0]"></x-mba-result>

            {{-- chart top selling item for each recommendations --}}
            @php $counter = 1; @endphp
            @foreach ($topRecommendations as $recommendation)
                @php
                    $recommendation['id'] = 'top' . (string) $counter++;
                @endphp
                <x-mba-top-item-category :recommendation="$recommendation" :rank="$counter - 1" :topSelling="$topSellingItem[$counter - 2]" :productDesc="$productDesc">
                </x-mba-top-item-category>
            @endforeach
        @endif
    </div>
</section>
