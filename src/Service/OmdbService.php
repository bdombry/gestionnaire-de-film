<?php

// src/Service/OmdbService.php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OmdbService
{
    private HttpClientInterface $client;
    private string $omdbApiKey;

    public function __construct(HttpClientInterface $client, string $omdbApiKey)
    {
        $this->client = $client;
        $this->omdbApiKey = $omdbApiKey;
    }

    public function searchMovie(string $title): ?string
    {
        $response = $this->client->request('GET', 'http://www.omdbapi.com/', [
            'query' => [
                'apikey' => $this->omdbApiKey,
                't' => $title,
            ],
        ]);

        $data = $response->toArray();

        return $data['Poster'] ?? null;
    }
}

