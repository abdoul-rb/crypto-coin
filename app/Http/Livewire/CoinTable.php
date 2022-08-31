<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CoinTable extends Component
{
    public $sortBy = 'market_cap_desc';
    public $search = null;

    public function render()
    {
        $data = [];

        if ($this->sortBy === 'market_cap_desc' || $this->sortBy === 'market_cap_asc') {
            $data = $this->sortByCap();
        }

        if ($this->sortBy === 'price_desc' || $this->sortBy === 'price_asc') {
            $data = $this->sortByPrice();
        }

        if (!is_null($this->search) || !empty($this->search)) {
            $data = $this->search($data);
        }

        return view('livewire.coin-table', [
            'coins' => $data
        ]);
    }

    /**
     * 
     */
    public function sortByPrice()
    {
        $params = http_build_query(['vs_currency'=> 'eur', 'per_page'=> 100, 'sparkline'=> false, 'price_change_percentage' => '1h,24h,7d']);

        $response = Http::get("https://api.coingecko.com/api/v3/coins/markets?$params");
        $response = (array)$response->object();

        usort($response, function($a1, $a2) { 
            return ($this->sortBy === 'price_asc') ? ($a1->current_price < $a2->current_price ? -1 : 1) : ($a1->current_price < $a2->current_price ? 1 : -1); 
        });

        return $response;
    }

    /**
     * 
     */
    public function sortByCap()
    {
        $params = http_build_query(['vs_currency'=> 'eur', 'order'=> $this->sortBy, 'per_page'=> 100, 'sparkline'=> false, 'price_change_percentage' => '1h,24h,7d']);

        $response = Http::get("https://api.coingecko.com/api/v3/coins/markets?$params");

        return $response->object();
    }


    public function switchMarketCapOrder()
    {
        $this->sortBy = $this->sortBy === 'market_cap_desc' ? 'market_cap_asc' : 'market_cap_desc';
    }

    public function switchPriceOrder()
    {
        $this->sortBy = $this->sortBy === 'price_desc' ? 'price_asc' : 'price_desc';
    }

    private function search($data)
    {
        $this->search = strtolower(trim($this->search));

        $filteredData = array_filter($data, function ($value) {
            return str_contains(strtolower($value->id), $this->search) || 
                str_contains(strtolower($value->name), $this->search) || 
                str_contains(strtolower($value->symbol), $this->search);
        });

        return $filteredData;
    }
}
