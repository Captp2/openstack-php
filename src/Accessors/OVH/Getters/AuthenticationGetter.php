<?php

namespace OvhSwift\Accessors\OVH\Getters;

use GuzzleHttp\Client;
use OvhSwift\Entities\Authentication;
use OvhSwift\Interfaces\Getters\IGetAuthentication;
use OvhSwift\Accessors\AbstractAccessor;

class AuthenticationGetter extends AbstractAccessor implements IGetAuthentication
{
    const AUTH_URI = 'https://auth.cloud.ovh.net/v3/auth/tokens';

    private Client $guzzleClient;

    public function __construct()
    {
        parent::__construct();
        $this->initializeGuzzleClient();
    }

    /**
     * @return Authentication
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \OvhSwift\Exceptions\InvalidConfigException
     */
    public function getAuthentication(): Authentication
    {
        $request = $this->guzzleClient->request('POST', self::AUTH_URI, ['json' => $this->getBody()]);

        return new Authentication(['token' => $request->getHeaderLine('x-subject-token')]);
    }

    /**
     * @return array[]
     * @throws \OvhSwift\Exceptions\InvalidConfigException
     */
    private function getBody(): array
    {
        $ovhConfig = $this->getOption('ovh');
        return [
            'auth' => [
                'identity' => [
                    'methods' => [
                        'password'
                    ],
                    'password' => [
                        'user' => [
                            'name' => $ovhConfig['username'],
                            "password" => $ovhConfig['password'],
                            "domain" => [
                                "id" => $ovhConfig['domain_id']
                            ]
                        ]
                    ]
                ],
                "scope" => [
                    "project" => [
                        "id" => $ovhConfig['project_id']
                    ]
                ]
            ]
        ];
    }

    private function initializeGuzzleClient()
    {
        $this->guzzleClient = new Client();
    }
}