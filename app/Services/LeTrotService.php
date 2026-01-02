<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LeTrotService
{
    
    public function profileExists(?string $url): bool
    {
        $url = trim((string) $url);

        // Allow empty field
        if ($url === '') {
            return true;
        }

        // Validate URL format
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        $host = strtolower((string) parse_url($url, PHP_URL_HOST));
        if ($host === '' || !str_contains($host, 'letrot.com')) {
            return false;
        }

        try {
            $response = Http::timeout(8)
                ->withHeaders([
                    'User-Agent' => 'StableTrack/1.0 (Laravel project)',
                    'Accept' => 'text/html,application/xhtml+xml',
                ])
                ->get($url);

            if (!$response->ok()) {
                return false;
            }

            
            return strlen($response->body()) > 500;

        } catch (\Throwable $e) {
            return false;
        }
    }
}




