<?php

namespace OvhSwift\Accessors\OVH\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Accessors\OVH\Getters\ContainerGetter;
use OvhSwift\Interfaces\API\Setters\ISetContainers;

class ContainerSetter extends AbstractAccessor implements ISetContainers
{
    /**
     * @param $name
     * @return AccessorResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createContainer(string $name): AccessorResponse
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
     * @param bool $forceDelete
     * @return AccessorResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \OvhSwift\Exceptions\ResourceNotFoundException
     */
    public function deleteContainer(string $name, bool $forceDelete = false): AccessorResponse
    {
        $request = $this->requestContainerDeletion($name);

        $response = match ($statusCode = $request->getStatusCode()) {
            204 => [],
            404 => ['success' => false, 'code' => 404, 'message' => "Container {$name} not found"],
            409 => $forceDelete ? $this->deleteAllFiles($name) : ['success' => false, 'code' => 409, 'message' => "Container {$name} is not empty"],
            default => ['success' => false, 'errors' => [
                'code' => $statusCode,
                'message' => 'Unknown error'
            ]],
        };

        return new AccessorResponse($response);
    }

    /**
     * @param string $containerName
     * @return AccessorResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \OvhSwift\Exceptions\ResourceNotFoundException
     *
     * A bit dirty but brain-fried right now
     */
    private function deleteAllFiles(string $containerName): array
    {
        $files = (new ContainerGetter(['authentication' => $this->authentication]))->listItems($containerName);
        foreach ($files as $file) {
            (new FileSetter(['authentication' => $this->authentication]))->deleteFile($containerName, $file->name);
        }

        $request = $this->requestContainerDeletion($containerName);
        return match ($statusCode = $request->getStatusCode()) {
            404 => ['success' => false, 'code' => 404, 'message' => "Container {$name} not found"],
            204 => [],
            default => ['success' => false, 'errors' => [
                'code' => $statusCode,
                'message' => 'Unknown error'
            ]],
            409 => ['success' => false, 'code' => 409, 'message' => "Container {$name} is not empty"]
        };
    }

    /**
     * @param string $name
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function requestContainerDeletion(string $name)
    {
        $request = $this->guzzleClient->request(
            'DELETE',
            $this->authentication->swiftUrl . "/{$name}",
            [
                'headers' => [
                    'X-Auth-Token' => $this->authentication->token,
                ]
            ]);

        return $request;
    }
}