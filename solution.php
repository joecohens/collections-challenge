<?php

require __DIR__.'/vendor/autoload.php';

$data = file_get_contents(__DIR__.'/stubs/data.json');

$customers = new \Illuminate\Support\Collection(json_decode($data));

$totalSalesByItem = $customers->filter(function ($customer) {
        return $customer->country == 'MEX';
    })->flatMap(function ($customer) {
        return $customer->orders;
    })->filter(function ($order) {
        return $order->status == 'paid';
    })->flatMap(function ($order) {
        return $order->items;
    })->reduce(function ($carry, $item) {
        return $carry + $item->total;
    });

echo '$'.number_format($totalSalesByItem, 2)."\n";