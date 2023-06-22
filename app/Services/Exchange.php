<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Exchange
{
    public static function convert(string $currency, float $amount): float|null
    {
        $convertResponse = Http::withoutVerifying()
            ->get(config('integrations.exchange.latest_url') .
                '?access_key=' . config('integrations.exchange.api_key') . '&format=1');

        if ($convertResponse->ok()) {
            $data = collect($convertResponse->json());

            if ($data->contains($currency)) {
                return (float)$data['rates'][$currency] * $amount;
            }
        }
    }
}
