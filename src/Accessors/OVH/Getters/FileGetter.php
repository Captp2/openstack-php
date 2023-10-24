<?php

namespace OvhSwift\Accessors\OVH\Getters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;
use OvhSwift\Entities\File;
use OvhSwift\Interfaces\Getters\IGetFiles;
use OvhSwift\Traits\Guzzle;

class FileGetter extends AbstractAccessor implements IGetFiles
{
    use Guzzle;

    public function __construct()
    {
        $this->initializeGuzzleClient();
        parent::__construct();
    }

    public function getFileByName(Authentication $authentication, string $containerName, string $fileName): ?File
    {
        $request = $this->guzzleClient->request(
            'GET',
            $authentication->swiftUrl . "/{$containerName}/{$fileName}",
            [
                'headers' => [
                    'X-Auth-Token' => $authentication->token,
                    'Accept' => 'application/json'
                ]
            ]);


        $responseItems = json_decode($request->getBody()->getContents(), true);
        ray($responseItems);
    }
}