<?php

namespace OvhSwift\Traits;

use GuzzleHttp\Client;

trait Guzzle
{
    protected Client $guzzleClient;

    /**
     * @return void
     */
    private function initializeGuzzleClient(): void
    {
        $this->guzzleClient = new Client(['http_errors' => false]);
    }
}