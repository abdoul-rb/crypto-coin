<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ChartComponent extends Component
{
    public $coinId;


    public function render()
    {
        return view('livewire.chart-component', [
            'coinId' => $this->coinId,
            'data' => $this->chartData()
        ]);
    }

    public function getCoinPrices()
    {
        $params = http_build_query(['vs_currency'=> 'eur', 'days'=> 7]);

        $response = Http::get("https://api.coingecko.com/api/v3/coins/$this->coinId/market_chart?$params");
        $response = (array)$response->object();

        return $response['prices'];
    }

    public function chartData()
    {
        $prices =  $this->getCoinPrices();

        $labels = array_map(function ($price) {
            return date("Y-m-d", substr($price[0], 0, 10));
        }, $prices);

        $data = array_map(function ($price) {
                return [
                    'x' => date('Y-m-d H:i:s', substr($price[0], 0, 10)),
                    'y' => $price[1]
                ];
            }, $prices);

        return ['labels' => $labels, 'data' => $data];
    }
}
