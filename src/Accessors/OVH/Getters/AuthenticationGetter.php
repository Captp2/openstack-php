<?php

namespace OvhSwift\Accessors\OVH\Getters;

use JetBrains\PhpStorm\ArrayShape;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;
use OvhSwift\Traits\Guzzle;

class AuthenticationGetter extends AbstractAccessor implements \OvhSwift\Interfaces\API\Getters\IGetAuthentication
{
    use Guzzle;

    const AUTH_URI = 'https://auth.cloud.ovh.net/v3/auth/tokens';
    private array $ovhConfig;

    public function __construct()
    {
        parent::__construct();
        $this->ovhConfig = $this->getOption('ovh.config');
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
        $requestBody = json_decode($request->getBody()->getContents(), true);

        return new Authentication(
            [
                'token' => $request->getHeaderLine('x-subject-token'),
                'swiftUrl' => $this->getEndpoint($requestBody['token']['catalog'])
            ]
        );
    }

    /**
     * @param $catalogs
     * @return string
     */
    private function getEndpoint($catalogs): string
    {
        foreach ($catalogs as $catalog) {
            if ($catalog['name'] === $this->ovhConfig['protocol']) {
                foreach ($catalog['endpoints'] as $endpoint) {
                    if ($endpoint['region_id'] === $this->ovhConfig['region']) {
                        return $endpoint['url'];
                    }
                }
            }
        }
    }

    /**
     * @return array[]
     * @throws \OvhSwift\Exceptions\InvalidConfigException
     */
    #[ArrayShape(['auth' => "array"])] private function getBody(): array
    {
        return [
            'auth' => [
                'identity' => [
                    'methods' => [
                        'password'
                    ],
                    'password' => [
                        'user' => [
                            'name' => $this->ovhConfig['username'],
                            "password" => $this->ovhConfig['password'],
                            "domain" => [
                                "id" => $this->ovhConfig['domain_id']
                            ]
                        ]
                    ]
                ],
                "scope" => [
                    "project" => [
                        "id" => $this->ovhConfig['project_id']
                    ]
                ]
            ]
        ];
    }
}