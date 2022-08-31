@extends('layouts.app')

@section('title', 'Coin détails')

@section('content')

<div class="text-white">
    
    <aside class="">
        <span class="bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
            #Rank {{ $coin->market_cap_rank }}
        </span>
        <div>
            <h1 class="flex items-center space-x-2 mt-2">
                <img class="w-10 h-10 rounded-full object-cover" src="{{ $coin->image->small }}" alt="{{ $coin->image->small }}">
                <p class="text-3xl font-bold md:text-5xl text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    {{ $coin->name }} <span class="text-white text-4xl">({{ Illuminate\Support\Str::upper($coin->symbol) }})</span>
                </p>
            </h1>

            <div class="flex items-center space-x-4 mt-2">
                <p class="text-3xl font-medium text-white">
                    {{ number_format($coin->market_data->current_price->eur, 2, ',', ' ') }} €
                </p>
                <span class="text-sm font-medium px-4 py-1.5 rounded text-white dark:text-gray-100 {{ $coin->market_data->price_change_percentage_24h > 0 ? 'bg-green-500 dark:bg-green-700' : 'bg-red-500 dark:bg-red-700' }}">
                    {{ round($coin->market_data->price_change_percentage_24h, 2) }} %
                </span>
            </div>
        </div>
    </aside>

    <section class="grid sm:grid-cols-6 gap-12 my-6">
        <div class="sm:col-span-4 py-2">
            <div class="grid sm:grid-cols-2 gap-6">
                <div class="px-4 py-6 max-w-xl bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
                        Capitalisation boursière
                    </h5>

                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 text-2xl">
                        {{ number_format($coin->market_data->market_cap->eur, 0, ',', ' ') }} €
                    </p>

                    <div class="text-red-400">
                        {{ round($coin->market_data->market_cap_change_percentage_24h, 2) }} %
                    </div>
                </div>

                <div class="px-4 py-6 max-w-xl bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
                        Valorisation entièrement diluée
                    </h5>

                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 text-2xl">
                        {{ empty($coin->market_data->fully_diluted_valuation) ? number_format($coin->market_data->fully_diluted_valuation->eur, 0, ',', ' ') : '' }} €
                    </p>
                </div>

                <div class="px-4 py-6 max-w-xl bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
                        Approvisionnement total
                    </h5>

                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 text-2xl">
                        {{ number_format($coin->market_data->total_supply, 0, ',', ' ') }} €
                    </p>
                </div>

                <div class="px-4 py-6 max-w-xl bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
                        Approvisionnement maximal
                    </h5>

                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 text-2xl">
                        {{ number_format($coin->market_data->max_supply, 0, ',', ' ') }} €
                    </p>
                </div>
            </div>
        </div>

        <div class="sm:col-span-2 overflow-x-scroll">
            <p class="text-2xl font-medium">Informations</p>
            <div class="mt-3 space-y-6">
                <div class="grid sm:grid-cols-3 gap-3 items-center">
                    <p class="text-sm font-medium sm:col-span-1">Site web</p>
                    <div class="sm:col-span-2 space-x-2">
                        @foreach($coin->links->homepage as $link)
                            @if(!empty($link))
                            <a href="{{ $link }}" class="inline-flex bg-gray-100 text-blue-900 text-xs font-semibold px-4 py-1.5 rounded dark:bg-gray-700 dark:text-blue-400">
                                {{ strstr($link, '/') }}
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="grid sm:grid-cols-3 gap-3">
                    <p class="text-sm font-medium sm:col-span-1 pt-1">Blockchain sites</p>
                    <div class="sm:col-span-2 space-y-2">
                        @foreach($coin->links->blockchain_site as $link)
                            @if(!empty($link))
                            <a href="{{ $link }}" class="inline-flex bg-gray-100 text-blue-900 text-xs font-semibold px-4 py-1.5 rounded dark:bg-gray-700 dark:text-blue-400">
                                {{ substr($link, 8) }}
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="grid sm:grid-cols-3 gap-3">
                    <p class="text-sm font-medium sm:col-span-1 pt-1">Repositories</p>
                    <div class="sm:col-span-2 space-y-2">
                        @foreach(array_merge($coin->links->repos_url->github, $coin->links->repos_url->bitbucket) as $link)
                            @if(!empty($link))
                            <a href="{{ $link }}" class="inline-flex bg-gray-100 text-blue-900 text-xs font-semibold px-4 py-1.5 rounded dark:bg-gray-700 dark:text-blue-400">
                                {{ substr($link, 8) }}
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <aside class="grid sm:grid-cols-6 gap-12 my-8">
        <div class="sm:col-span-4 py-2 border">
            <livewire:chart-component :coinId="$id"/>
        </div>

        <div class="sm:col-span-2">
            <p class="text-2xl font-medium">Statistiques des prix {{ Illuminate\Support\Str::upper($coin->symbol) }}</p>
            
            <div class="mt-3 space-y-6">
                <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 text-base font-medium text-gray-900 truncate dark:text-white">
                                Prix actuel
                            </div>
                            <div class="inline-flex items-center text-base font-medium text-gray-900 dark:text-white">
                                {{ number_format($coin->market_data->current_price->eur, 2, ',', ' ') }} €
                            </div>
                        </div>
                    </li>

                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 text-base font-medium text-gray-900 truncate dark:text-white">
                                24h Low / 24h High
                            </div>
                            <div class="inline-flex items-center text-base font-medium text-gray-900 dark:text-white">
                                {{ number_format($coin->market_data->low_24h->eur, 2, ',', ' ') }} € /
                                {{ number_format($coin->market_data->high_24h->eur, 2, ',', ' ') }} € 
                            </div>
                        </div>
                    </li>

                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 text-base font-medium text-gray-900 truncate dark:text-white">
                                Volume total
                            </div>
                            <div class="inline-flex items-center text-base font-medium text-gray-900 dark:text-white">
                                {{ number_format($coin->market_data->total_volume->eur, 2, ',', ' ') }} €
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </aside>

    <!-- {{ var_dump($coin->market_data) }} -->
</div>

@endsection