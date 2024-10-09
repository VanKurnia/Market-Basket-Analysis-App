<section class="bg-white dark:bg-gray-900 my-auto">
    <div class="py-8 px-4 mx-auto max-w-5xl lg:py-16">

        {{-- Page Heading --}}
        <h2 class="mb-4 text-3xl text-center font-bold text-gray-900 dark:text-white">
            Market Basket Analysis for Retail Store<br>
            Using Apriori Algorithm<br>
            🛒 🏪 💹 💵
        </h2>

        @if ($topRecommendations == [])
            {{-- Form --}}
            <x-mba-form></x-mba-form>
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
