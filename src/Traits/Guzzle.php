<?php

namespace OvhSwift\Traits;

use GuzzleHttp\Client;

trait Guzzle
{
    private Client $guzzleClient;

    /**
     * @return void
     */
    private function initializeGuzzleClient(): void
    {
        $this->guzzleClient = new Client();
    }
}