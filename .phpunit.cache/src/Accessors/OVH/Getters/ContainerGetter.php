<?php

namespace OvhSwift\Accessors\OVH\Getters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;
use OvhSwift\Entities\Container;
use OvhSwift\Entities\File;
use OvhSwift\Exceptions\ResourceNotFoundException;
use OvhSwift\Interfaces\API\Getters\IGetContainers;
use OvhSwift\Traits\Guzzle;

class ContainerGetter extends AbstractAccessor implements IGetContainers
{
    /**
     * @return Container[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listContainers(): array
    {
        $request = $this->guzzleClient->request(
            'GET',
            $this->authentication->swiftUrl,
            [
                'headers' => [
                    'X-Auth-Token' => $this->authentication->token,
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
     * @param string $name
     * @return array|null
     * @throws ResourceNotFoundException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listItems(string $name): ?array
    {
        $request = $this->guzzleClient->request(
            'GET',
            $this->authentication->swiftUrl . "/" . $name,
            [
                'headers' => [
                    'X-Auth-Token' => $this->authentication->token,
                    'Accept' => 'application/json'
                ]
            ]);

        if($request->getStatusCode() === 404) {
            throw new ResourceNotFoundException("Container {$name} not found");
        }

        $containerItems = json_decode($request->getBody()->getContents(), true);
        $files = [];
        foreach ($containerItems as $file) {
            $files[] = new File([
                'name' => $file['name'],
                'path' => $this->authentication->swiftUrl . "/{$name}/" . $file['name'],
                'size' => $file['bytes'],
                'mimeType' => $file['content_type'],
                'lastModified' => new \DateTime($file['last_modified'])
            ]);
        }

        return $files;
    }

    /**
     * @param string $name
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function containerExists(string $name): bool
    {
        $request = $this->guzzleClient->request(
            'GET',
            $this->authentication->swiftUrl . "/" . $name,
            [
                'headers' => [
                    'X-Auth-Token' => $this->authentication->token,
                    'Accept' => 'application/json'
                ]
            ]);

        return !($request->getStatusCode() === 404);
    }
}