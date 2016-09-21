<?php

$data = file_get_contents(__DIR__.'/stubs/data.json');

$customers = json_decode($data);

$totalSalesByItem = 0;

foreach ($customers as $customer) {
    $countryCode = $customer->country;
    if ($countryCode == 'MEX') {
        $orders = $customer->orders;
        foreach ($orders as $order) {
            if ($order->status == 'paid') {
                foreach ($order->items as $item) {
                    $totalSalesByItem += $item->total;
                }
            }
        }
    }
}

echo '$'.number_format($totalSalesByItem, 2)."\n";