<?php

namespace OvhSwift\Accessors\OVH\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;
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
    public function uploadFile(string $containerName, string $fileName, string $filePath): bool
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

        return $request->getStatusCode() === 201;
    }

    /**
     * @param string $containerName
     * @param string $fileName
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteFile(string $containerName, string $fileName): bool
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

        return $request->getStatusCode() === 204;
    }
}