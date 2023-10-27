<?php

namespace OvhSwift\Accessors\OVH\Getters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;
use OvhSwift\Entities\Container;
use OvhSwift\Entities\File;
use OvhSwift\Interfaces\API\Getters\IGetContainers;
use OvhSwift\Traits\Guzzle;

class ContainerGetter extends AbstractAccessor implements IGetContainers
{
    /**
     * @param Authentication $authentication
     * @return Container[]
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
                'name' => $container['name'],
                'itemCount' => $container['count'],
                'size' => $container['bytes'],
                'lastModified' => new \DateTime($container['last_modified'])
            ]);
        }

        return $containers;
    }

    /**
     * @param Authentication $authentication
     * @param string $name
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listItems(Authentication $authentication, string $name): array
    {
        $request = $this->guzzleClient->request(
            'GET',
            $authentication->swiftUrl . "/" . $name,
            [
                'headers' => [
                    'X-Auth-Token' => $authentication->token,
                    'Accept' => 'application/json'
                ]
            ]);

        $containerItems = json_decode($request->getBody()->getContents(), true);
        $files = [];
        foreach ($containerItems as $file) {
            $files[] = new File([
                'name' => $file['name'],
                'path' => $authentication->swiftUrl . "/{$name}/" . $file['name'],
                'size' => $file['bytes'],
                'mimeType' => $file['content_type'],
                'lastModified' => new \DateTime($file['last_modified'])
            ]);
        }

        return $files;
    }
}