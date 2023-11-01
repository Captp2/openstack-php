<?php

namespace OvhSwift\Accessors\OVH\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Interfaces\API\Setters\ISetContainers;

class ContainerSetter extends AbstractAccessor implements ISetContainers
{
    /**
     * @param $name
     * @return AccessorResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createContainer($name): AccessorResponse
    {
        $request = $this->guzzleClient->request(
            'PUT',
            $this->authentication->swiftUrl . "/{$name}",
            [
                'headers' => [
                    'X-Auth-Token' => $this->authentication->token,
                    'Accept' => 'application/json'
                ]
            ]);

        $response = [];
        if ($statusCode = $request->getStatusCode() !== 201) {
            $response = [
                'success' => false,
                'code' => $statusCode,
                'message' => 'Unknown error'
            ];
        }

        return new AccessorResponse($response);
    }

    /**
     * @param string $name
     * @return AccessorResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteContainer(string $name): AccessorResponse
    {
        $request = $this->guzzleClient->request(
            'DELETE',
            $this->authentication->swiftUrl . "/{$name}",
            [
                'headers' => [
                    'X-Auth-Token' => $this->authentication->token,
                ]
            ]);

        $response = match ($statusCode = $request->getStatusCode()) {
            404 => ['success' => false, 'code' => 404, 'message' => "Container {$name} not found"],
            204 => [],
            default => ['success' => false, 'errors' => [
                'code' => $statusCode,
                'message' => 'Unknown error'
            ]],
        };

        return new AccessorResponse($response);
    }
}