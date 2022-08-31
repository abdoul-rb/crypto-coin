<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CoinController extends Controller
{
    public function index()
    {
        return view('coins.index');
    }

    /**
     * Show the details for a coin.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        $params = http_build_query(['market_data'=> true, 'developer_data'=> true, 'sparkline'=> false, 'localization' => false]);

        $response = Http::get("https://api.coingecko.com/api/v3/coins/$id?$params");
        
        return view('coins.show', [
            'coin' => $response->object(),
            'id' => $id
        ]);
    }
}
