<?php

namespace OvhSwift\Accessors\OVH\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;
use OvhSwift\Interfaces\API\Setters\ISetContainers;

class ContainerSetter extends AbstractAccessor implements ISetContainers
{
    /**
     * @param Authentication $authentication
     * @param $name
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createContainer(Authentication $authentication, $name): bool
    {
        $request = $this->guzzleClient->request(
            'PUT',
            $authentication->swiftUrl . "/{$name}",
            [
                'headers' => [
                    'X-Auth-Token' => $authentication->token,
                    'Accept' => 'application/json'
                ]
            ]);

        return $request->getStatusCode() === 201;
    }

    /**
     * @param Authentication $authentication
     * @param string $name
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteContainer(Authentication $authentication, string $name): bool
    {
        $request = $this->guzzleClient->request(
            'DELETE',
            $authentication->swiftUrl . "/{$name}",
            [
                'headers' => [
                    'X-Auth-Token' => $authentication->token,
                ]
            ]);

        return $request->getStatusCode() === 204;
    }
}