<?php

namespace OvhSwift\Accessors\OVH\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Interfaces\API\Setters\ISetContainers;

class ContainerSetter extends AbstractAccessor implements ISetContainers
{
    /**
     * @param $name
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createContainer($name): bool
    {
        ray($this->authentication);
        $request = $this->guzzleClient->request(
            'PUT',
            $this->authentication->swiftUrl . "/{$name}",
            [
                'headers' => [
                    'X-Auth-Token' => $this->authentication->token,
                    'Accept' => 'application/json'
                ]
            ]);

        return $request->getStatusCode() === 201;
    }

    /**
     * @param string $name
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteContainer(string $name): bool
    {
        $request = $this->guzzleClient->request(
            'DELETE',
            $this->authentication->swiftUrl . "/{$name}",
            [
                'headers' => [
                    'X-Auth-Token' => $this->authentication->token,
                ]
            ]);

        return $request->getStatusCode() === 204;
    }
}