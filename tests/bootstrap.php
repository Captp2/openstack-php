<?php

use OvhSwift\Domains\ContainerManager;
use OvhSwift\Domains\FileManager;
use OvhSwift\Entities\File;
use OvhSwift\Tests\Mocks\SPI\ContainerUserMock;
use OvhSwift\Tests\Mocks\SPI\FileUserMock;

require_once __DIR__ . '/../vendor/autoload.php';

$containerManager = new ContainerManager(new ContainerUserMock());
$fileManager = new FileManager(new FileUserMock());

echo "-------------- BUILDING OBJECT STORAGES --------------\n";

$fileManager->uploadFile(
    "swift-test",
    new File([
        'name' => 'Sidonie.jpg',
        'path' => __DIR__ . '/Utils/Sidonie2.jpg',
        'mimeType' => 'image/jpeg',
        'size' => 123
    ]),
    true);


$fileManager->uploadFile(
    "swift-test-2",
    new File([
        'name' => 'Sidonie2.jpg',
        'path' => __DIR__ . '/Utils/Sidonie2.jpg',
        'mimeType' => 'image/jpeg',
        'size' => 123
    ]),
    true);


echo "-------------- OBJECT STORAGES BUILT --------------\n";
echo "-------------- WAITING FOR OPENSTACK TO REFRESH --------------\n";

sleep(5);

echo "-------------- RUNNING TESTS --------------\n";

register_shutdown_function(function () use ($containerManager, $fileManager) {
    echo "-------------- DELETING OBJECT STORAGES --------------\n";
    $containers = $containerManager->listContainers();

    foreach ($containers as $container) {
        echo "-------------- REMOVING CONTAINER {$container->name} --------------\n";
        foreach ($containerManager->listItems($container->name) as $file) {
            echo "-------------- DELETED FILE {$file->name} --------------\n";
            $fileManager->deleteFile($container->name, $file->name);
        }
        $containerManager->deleteContainer($container->name);
        echo "-------------- DELETED CONTAINER {$container->name} --------------\n";
    }
    echo "-------------- ALL STORAGES REMOVED --------------\n";
});