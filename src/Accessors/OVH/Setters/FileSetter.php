<?php

namespace OvhSwift\Accessors\OVH\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Interfaces\API\Setters\ISetFiles;
use OvhSwift\Traits\Guzzle;

class FileSetter extends AbstractAccessor implements ISetFiles
{
    use Guzzle;

    /**
     * @param string $containerName
     * @param string $fileName
     * @param string $filePath
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadFile(string $containerName, string $fileName, string $filePath): AccessorResponse
    {
        $request = $this->guzzleClient->request(
            'PUT',
            $this->authentication->swiftUrl . "/{$containerName}/{$fileName}",
            [
                'headers' => [
                    'X-Auth-Token' => $this->authentication->token,
                    'Accept' => 'application/json'
                ],
                'body' => fopen($filePath, 'r')
            ]);

        $response = $request->getStatusCode() === 201 ? [] :
            [
                'success' => false,
                'code' => $request->getStatusCode(),
                'message' => "Unknown error"
            ];

        return new AccessorResponse($response);
    }

    /**
     * @param string $containerName
     * @param string $fileName
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteFile(string $containerName, string $fileName): AccessorResponse
    {
        $request = $this->guzzleClient->request(
            'DELETE',
            $this->authentication->swiftUrl . "/{$containerName}/{$fileName}",
            [
                'headers' => [
                    'X-Auth-Token' => $this->authentication->token,
                    'Accept' => 'application/json'
                ],
            ]);

        $response = match ($statusCode = $request->getStatusCode()) {
            404 => ['success' => false, 'code' => 404, 'message' => "Resource not found"],
            204 => [],
            default => ['success' => false, 'errors' => [
                'code' => $statusCode,
                'message' => 'Unknown error'
            ]],
        };

        return new AccessorResponse($response);
    }
}