@props(['products'])
<form wire:submit.prevent="submitForm" action="#">

    {{-- Product Category Dropdown --}}
    <div class="grid gap-4 grid-cols-4 sm:grid-cols-4 sm:gap-6 mb-4">

        {{-- Product Category Filter --}}
        <div class="col-span-4">
            <label for="product" class="block mb-2 text-xl font-semibold text-gray-900 dark:text-white">
                Product Category
            </label>

            <div class="grid gap-4 grid-cols-3 sm:grid-cols-3 sm:gap-6 mb-4">
                @foreach ($products as $product)
                    <div class="col-span-1">
                        <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                            <input id="bordered-checkbox-{{ str_replace(' ', '', $product['category']) }}"
                                type="checkbox" value="{{ $product['category'] }}"
                                name="bordered-checkbox-{{ $product['category'] }}" wire:model="selectedCategories"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bordered-checkbox-{{ str_replace(' ', '', $product['category']) }}"
                                class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ $product['category'] }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>


        {{-- Time Filter --}}
        <div class="col-span-2">
            <label for="start-datepicker" class="block mb-2 text-xl font-semibold text-gray-900 dark:text-white">
                Start Date
            </label>
            <div class="relative max-w-lg">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input datepicker id="start-datepicker" type="text" wire:model='startDate' name="startDate"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Pilih waktu awal" datepicker-format="yyyy-mm-dd" datepicker-min-date="2020-06-01"
                    datepicker-max-date="2020-09-30" @change-date.camel="@this.set('startDate', $event.target.value)">
            </div>
        </div>

        <div class="col-span-2">
            <label for="end-datepicker" class="block mb-2 text-xl font-semibold text-gray-900 dark:text-white">
                End Date
            </label>
            <div class="relative max-w-lg">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input datepicker id="end-datepicker" type="text" wire:model="endDate" name="endDate"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Pilih waktu akhir" datepicker-format="yyyy-mm-dd" datepicker-min-date="2020-06-01"
                    datepicker-max-date="2020-09-30" @change-date.camel="@this.set('endDate', $event.target.value)">
            </div>
        </div>
    </div>

    {{-- Loading Animation --}}
    <div class="flex justify-center align-item-center mt-2">
        <div wire:loading.delay role="status">
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    {{-- Calculate Button --}}
    <div class="flex justify-center">
        <button type="submit"
            class="inline-flex items-center px-5 py-2.5 mt-2 sm:mt-6 text-lg font-semibold text-center text-white bg-green-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-green-900 hover:bg-green-800">
            Analyze
        </button>
    </div>
</form>
