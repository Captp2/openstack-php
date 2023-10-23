<?php

namespace OvhSwift\Accessors\OVH\Getters;

use Generator;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;
use OvhSwift\Entities\Container;
use OvhSwift\Interfaces\Getters\IGetContainers;
use OvhSwift\Traits\Guzzle;

class ContainerGetter extends AbstractAccessor implements IGetContainers
{
    use Guzzle;

    public function __construct()
    {
        $this->initializeGuzzleClient();
        parent::__construct();
    }

    /**
     * @param Authentication $authentication
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listContainers(Authentication $authentication): array
    {
        $request = $this->guzzleClient->request(
            'GET',
            $authentication->swiftUrl,
            [
                'headers' => [
                    'X-Auth-Token' => $authentication->token,
                    'Accept' => 'application/json'
                ]
            ]);


        $responseItems = json_decode($request->getBody()->getContents(), true);
        $containers = [];
        foreach ($responseItems as $container) {
            $containers[] = new Container([
                'id' => $container['name'],
                'itemCount' => $container['count'],
                'size' => $container['bytes'],
                'lastModified' => new \DateTime($container['last_modified'])
            ]);
        }

        return $containers;
    }
}