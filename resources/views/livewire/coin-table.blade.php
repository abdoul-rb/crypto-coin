<section class="overflow-x-auto relative shadow-md sm:rounded-lg mt-12">
    <!-- Search bar -->
    <div class="flex justify-end items-center pb-4 bg-white dark:bg-gray-900">
        <label for="search" class="sr-only">Recherche par nom</label>
        <div class="relative">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="search" wire:model.debounce.1s="search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher">
        </div>
    </div>
    <!-- Table -->
    <div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">#</th>
                    <th scope="col" class="py-3 px-6">Nom</th>
                    <th scope="col" class="py-3 px-6">Symbole</th>
                    <th scope="col" class="py-3 px-6">
                        <div class="flex items-center justify-end">
                            Prix
                            <button wire:click="switchPriceOrder">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                    <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                </svg>
                            </button>
                        </div>
                    </th>
                    <th scope="col" class="py-3 px-6 text-right">
                        <div class="flex items-center justify-end">
                            Cap boursière
                            <button wire:click="switchMarketCapOrder">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                    <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                </svg>
                            </button>
                        </div>
                    </th>
                    <th scope="col" class="py-3 px-6">1h %</th>
                    <th scope="col" class="py-3 px-6">24h %</th>
                    <th scope="col" class="py-3 px-6">7J %</th>
                    <th scope="col" class="py-3 px-6 text-right">Volume total</th>
                    <th scope="col" class="py-3 px-6 text-right"></th>
                </tr>
            </thead>
            <tbody id="crypto-list">
                @foreach ($coins as $key => $coin)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4 w-4">{{ $key + 1 }}</td>
                    <th scope="row" class="flex items-center py-4 px-6 text-gray-900 dark:text-white max-w-xs">
                        <img class="w-6 h-6 rounded-full object-cover" src="{{ $coin->image }}" alt="{{ $coin->name }}">
                        <div class="pl-3">
                            <a href="{{ route('coins.show', ['id' => $coin->id ]) }}" class="text-base font-semibold hover:underline">{{ $coin->name }}</a>
                        </div>  
                    </th>
                    <td class="py-4 px-6">{{ Illuminate\Support\Str::upper($coin->symbol) }}</td>
                    <td class="py-4 px-6 text-right" style="white-space: nowrap;">{{ number_format($coin->current_price, 2, ',', ' ') }}€</td>
                    <td class="py-4 px-6 text-right">{{ number_format($coin->market_cap, 2, ',', ' ') }}€</td>
                    <td class="py-4 px-6 {{ $coin->price_change_percentage_1h_in_currency > 0 ? 'text-green-400' : 'text-red-400' }}">
                        {{ round($coin->price_change_percentage_1h_in_currency, 2) }}
                        <!-- <div class="text-base font-semibold"></div>
                        <div class="pl-3">
                            <div class="font-normal text-gray-500">1,909,914 BTC</div>
                        </div> -->
                    </td>
                    <td class="py-4 px-6 {{ $coin->price_change_percentage_24h_in_currency > 0 ? 'text-green-400' : 'text-red-400' }}">
                        {{ round($coin->price_change_percentage_24h_in_currency, 2) }}
                    </td>
                    <td class="py-4 px-6 {{ $coin->price_change_percentage_7d_in_currency > 0 ? 'text-green-400' : 'text-red-400' }}">
                        {{ round($coin->price_change_percentage_7d_in_currency, 2) }}
                    </td>
                    <td class="py-4 px-6 text-right" style="white-space: nowrap;">{{ number_format($coin->total_volume, 2, ',', ' ') }}€</td>
                    <td class="py-4 px-6">
                        <!-- Dropdown menu -->
                        <div x-data="{ open: false, 
                                toggle() { 
                                    if (this.open) { return this.close() }  
                                    this.$refs.button.focus()
                                    this.open = true
                                },
                                close(focusAfter) {
                                    if (! this.open) return
                                    this.open = false
                                    focusAfter && focusAfter.focus()
                                }
                            }" class="relative" x-on:keydown.escape.prevent.stop="close($refs.button)" x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">
                            <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button" x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"> 
                                <svg class="w-3 h-3" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </button>
                            <div class="absolute z-10 right-0 mt-2 w-32 rounded-md divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" style="display: none;">
                                <ul class="py-1 text-sm text-gray-300 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                    <li>
                                        <a href="{{ route('coins.show', ['id' => $coin->id ]) }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Détails</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End dropdonw menu -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
