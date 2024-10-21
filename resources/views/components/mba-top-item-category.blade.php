@props(['recommendation', 'rank', 'topSelling', 'productDesc'])
<div x-data="{{ $recommendation['id'] }}: null" x-init="{{ $recommendation['id'] }} = new Chart(document.getElementById('{{ $recommendation['id'] }}').getContext('2d'), {
    type: 'doughnut',
    data: {
        {{-- labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'], --}}
        labels: [
            <?php $max = count($topSelling);
            for ($i = 0; $i < $max; $i++) {
                $label = $topSelling[$i];
                echo "'" . $label->product_name . "'" . ',';
            } ?>
        ],
        datasets: [{
            label: ['Banyak Item Terjual'],
            {{-- data: [12, 19, 3, 5, 2, 3], --}}
            data: [
                <?php $max = count($topSelling);
                for ($i = 0; $i < $max; $i++) {
                    $label = $topSelling[$i];
                    echo "'" . $label->total_sales . "'" . ',';
                } ?>
            ],
            borderWidth: 1,
            borderColor: '#ffff',
            backgroundColor: [
                'rgb(101, 163, 13)',
                'rgb(202, 138, 4)',
                'rgb(217, 119, 6)',
                'rgb(234, 88, 12)',
                'rgb(220, 38, 38)'
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

            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-yellow-200">
                {{ ucfirst(strtolower($recommendation['consequent'])) }} / {{ $productDesc[$rank]->description }}
            </h5>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Berikut merupakan analisis produk dengan penjualan terbanyak dalam kategori
                {{ strtolower($recommendation['consequent']) }} :
            </p>

            {{-- Chart --}}
            <div class="mt-4 grid grid-cols-6 gap-4">
                <div class="col-span-3">
                    <canvas id="{{ $recommendation['id'] }}" width="600" height="400">
                    </canvas>
                </div>
                <div class="col-span-3">
                    {{-- rank --}}
                    <span class="block text-white font-semibold mb-4">
                        Keterangan :
                    </span>
                    @php $numbering = 1; @endphp
                    @foreach ($topSelling as $salesNumber)
                        <h2 class="text-white font-semibold">
                            {{ $numbering++ }}. {{ $salesNumber->product_name }} => {{ $salesNumber->total_sales }}
                            item terjual
                        </h2>
                    @endforeach

                    {{-- saran --}}
                    <span class="block mt-8 text-yellow-200 font-semibold">
                        Hasil Analisis :
                    </span>
                    <?php
                    $productName = ucfirst(strtolower($recommendation['consequent'])) . '/' . $productDesc[$rank]->description;
                    ?>
                    @switch($rank)
                        @case(1)
                            <span class="block mt-2 text-cyan-300 font-semibold">
                                <span class="block mt-2 font-bold text-white"> Bundle: </span>
                                Anda dapat membuat diskon khusus atau penawaran bundle antara {{ $productName }} dan
                                {{ strtolower($recommendation['antecedent']) }} karena sering dibeli bersamaan. <br>
                                <span class="block mt-2 font-bold text-white"> Tata Letak: </span>
                                Letakkan {{ $productName }} bersama dengan {{ strtolower($recommendation['antecedent']) }}
                                yang sering dibeli bersamaan, untuk mendorong pembelian bersama.
                            </span>
                        @break

                        @case(2)
                            <span class="block mt-2 text-cyan-300 font-semibold">
                                <span class="block mt-2 font-bold text-white"> Bundle: </span>
                                Pertimbangkan diskon beli satu gratis satu atau potongan harga saat {{ $productName }} dibeli
                                bersama
                                {{ strtolower($recommendation['antecedent']) }}. Strategi ini bisa menarik minat konsumen.<br>
                                <span class="block mt-2 font-bold text-white"> Tata Letak: </span>
                                Letakkan {{ $productName }} bersama {{ strtolower($recommendation['antecedent']) }} untuk
                                mendorong pembelian yang lebih besar.
                            </span>
                        @break

                        @case(3)
                            <span class="block mt-2 text-cyan-300 font-semibold">
                                <span class="block mt-2 font-bold text-white"> Bundle: </span>
                                Buat penawaran kombo dengan harga yang lebih terjangkau jika konsumen membeli
                                {{ $productName }} bersama
                                {{ strtolower($recommendation['antecedent']) }}. Strategi ini bisa meningkatkan penjualan kedua
                                produk.<br>
                                <span class="block mt-2 font-bold text-white"> Tata Letak: </span>
                                Pastikan {{ $productName }} selalu dipromosikan bersama
                                {{ strtolower($recommendation['antecedent']) }}, sehingga konsumen lebih
                                tergoda untuk membeli kedua produk.
                            </span>
                        @break

                        @case(4)
                            <span class="block mt-2 text-cyan-300 font-semibold">
                                <span class="block mt-2 font-bold text-white"> Bundle: </span>
                                Diskon untuk pembelian bersama {{ strtolower($recommendation['antecedent']) }} dapat
                                memaksimalkan penjualan. Misalnya, jika
                                membeli {{ $productName }} dengan {{ strtolower($recommendation['antecedent']) }}, tawarkan
                                diskon tambahan.<br>
                                <span class="block mt-2 font-bold text-white"> Tata Letak: </span>
                                Susun {{ $productName }} bersama {{ strtolower($recommendation['antecedent']) }} di etalase
                                rekomendasi atau promosi khusus.
                            </span>
                        @break

                        @case(5)
                            <span class="block mt-2 text-cyan-300 font-semibold">
                                <span class="block mt-2 font-bold text-white"> Bundle: </span>
                                Penawaran harga spesial saat {{ $productName }} dibeli dengan
                                {{ strtolower($recommendation['antecedent']) }} dapat membantu
                                meningkatkan penjualan.<br>
                                <span class="block mt-2 font-bold text-white"> Tata Letak: </span>
                                Selalu asosiasikan {{ $productName }} dengan {{ strtolower($recommendation['antecedent']) }}
                                dalam promosi Anda.
                            </span>
                        @break

                        @default
                            <span class="block mt-2 text-white font-semibold">
                                Tidak ada rekomendasi tambahan.
                            </span>
                    @endswitch
                </div>
            </div>

        </div>
    </div>
</div>
