<?php

namespace OvhSwift\Tests\Accessors;

use GuzzleHttp\Exception\ClientException;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\OVH\Setters\ContainerSetter;
use OvhSwift\Domains\Authenticator;
use OvhSwift\Entities\Authentication;
use OvhSwift\Tests\AbstractTester;

class AbstractAccessorTester extends AbstractTester
{
    const CONTAINER_NAME = 'swift-test';
    const FILE_NAME = 'Sidonie.jpg';
    const FILE_SIZE = 60692;

    protected array $containerNames = [];

    protected string $accessorClass;
    public AbstractAccessor $accessor;

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function tearDown(): void
    {
        if(!empty($this->containerNames)) {
            $containerSetter = (new ContainerSetter(['authentication' => $this->authentication]));
            foreach ($this->containerNames as $containerName) {
                try {
                    $containerSetter->deleteContainer($containerName);
                } catch (ClientException $e) {
                    if (!$e->getCode() == 404) {
                        throw $e;
                    }
                }
            }
        }
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->accessor = new $this->accessorClass(['authentication' => $this->authentication]);
    }
}