<?php

namespace OvhSwift\Accessors\OVH\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;
use OvhSwift\Interfaces\API\Setters\ISetFiles;
use OvhSwift\Traits\Guzzle;

class FileSetter extends AbstractAccessor implements ISetFiles
{
    use Guzzle;

    public function uploadFile(Authentication $authentication, string $containerName, string $fileName, string $filePath): bool
    {
        $request = $this->guzzleClient->request(
            'PUT',
            $authentication->swiftUrl . "/{$containerName}/{$fileName}",
            [
                'headers' => [
                    'X-Auth-Token' => $authentication->token,
                    'Accept' => 'application/json'
                ],
                'body' => fopen($filePath, 'r')
            ]);

        return $request->getStatusCode() === 201;
    }

    public function deleteFile(Authentication $authentication, string $containerName, string $fileName): bool
    {
        $request = $this->guzzleClient->request(
            'DELETE',
            $authentication->swiftUrl . "/{$containerName}/{$fileName}",
            [
                'headers' => [
                    'X-Auth-Token' => $authentication->token,
                    'Accept' => 'application/json'
                ],
            ]);

        return $request->getStatusCode() === 204;
    }
}