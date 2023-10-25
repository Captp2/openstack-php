<?php

namespace OvhSwift\Accessors\OVH\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;
use OvhSwift\Interfaces\API\Setters\ISetFiles;
use OvhSwift\Traits\Guzzle;

class FileSetter extends AbstractAccessor implements ISetFiles
{
    use Guzzle;

    public function uploadFile(Authentication $authentication, string $containerName, string $fileName, string $fileData)
    {
//        $request = $this->guzzleClient->request(
//            'PUT',
//            $authentication->swiftUrl . "/{$containerName}",
//            [
//                'headers' => [
//                    'X-Auth-Token' => $authentication->token,
//                    'Accept' => 'application/json'
//                ]
//            ]);
    }
}