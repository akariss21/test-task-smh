<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DummyJsonImporter
{
    protected string $baseUrl = 'https://dummyjson.com';

    public function fetch(string $resource): array
    {
        $response = Http::get("{$this->baseUrl}/{$resource}?limit=100");

        if ($response->failed()) {
            throw new \Exception("Failed to fetch {$resource}");
        }

        return $response->json()[$resource] ?? [];
    }

    public function filterByKeyword(array $items, string $keyword): array
    {
        return array_filter($items, fn($item) => str_contains(strtolower($item['title'] ?? ''), strtolower($keyword)));
    }
}
