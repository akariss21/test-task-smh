<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\DummyJsonImporter;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class ImportIphones extends Command
{
    protected $signature = 'import:iphones';
    protected $description = 'Импортирует iPhone продукты из dummyjson.com';

    public function handle(DummyJsonImporter $importer)
    {
        echo "Загружаем продукты...\n";

        $response = Http::get('https://dummyjson.com/products/search', [
            'q' => 'iphone',
        ]);

        if (!$response->ok()) {
            echo "Ошибка запроса: {$response->status()}\n";
            return;
        }

        $products = $response->json('products') ?? [];

        foreach ($products as $product) {
                Product::updateOrCreate(
                ['external_id' => $product['id']],
                [
                    'title' => $product['title'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'brand' => $product['brand'],
                    'category' => $product['category'],
                    'thumbnail' => $product['thumbnail'],
                    'images' => $product['images'],
                ]
            );

        }

        $this->info('Импорт завершен: ' . count($products) . ' продуктов iPhone добавлены.');
    }
}
