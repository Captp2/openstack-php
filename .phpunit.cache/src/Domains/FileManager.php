<?php

namespace OvhSwift\Domains;

use GuzzleHttp\Exception\GuzzleException;
use OvhSwift\Accessors\OVH\Setters\FileSetter;
use OvhSwift\Entities\File;
use OvhSwift\Exceptions\OpenStackException;
use OvhSwift\Exceptions\ResourceNotFoundException;
use OvhSwift\Exceptions\ResourceValidationException;
use OvhSwift\Interfaces\API\Getters\IGetFiles;
use OvhSwift\Interfaces\API\Setters\ISetFiles;
use OvhSwift\Interfaces\SPI\IUseFiles;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileManager extends AbstractDomain
{
    /**
     * @var IUseFiles $spiAdapter
     */
    protected object $spiAdapter;

    /**
     * @var FileSetter
     */
    protected object $setter;

    /**
     * @param string $containerName
     * @param string $fileName
     * @return mixed
     * @throws ResourceNotFoundException
     */
    public function findByName(string $containerName, string $fileName): File
    {
        if (!$file = $this->getter->getFileByName($containerName, $fileName)) {
            throw new ResourceNotFoundException("File {$fileName} not found in {$containerName}");
        }

        return $file;
    }

    /**
     * @param string $containerName
     * @param File $file
     * @return bool
     * @throws OpenStackException
     * @throws ResourceNotFoundException
     * @throws ResourceValidationException
     * @throws GuzzleException
     */
    public function uploadFile(string $containerName, File $file, $createContainer = false): string
    {
        if (!$this->spiAdapter->validateFileName($file->name)) {
            throw new ResourceValidationException("Filename {$file->name} is invalid");
        }
        if (!$this->spiAdapter->validateMimeType($file->mimeType)) {
            throw new ResourceValidationException("Filetype {$file->mimeType} is invalid");
        }
        if (!$this->spiAdapter->validateFileSize($file->size)) {
            throw new ResourceValidationException("Filesize is invalid");
        }

        $response = $this->setter->uploadFile($containerName, $file->name, $file->path, $createContainer);
        if (!$response->success) {
            if (isset($response->errors['404'])) {
                throw new ResourceNotFoundException($response->errors['404']);
            }

            throw new OpenStackException($response->errors['code']);
        }

        return $response->data['path'];
    }

    /**
     * @param string $containerName
     * @param string $fileName
     * @return bool
     * @throws OpenStackException
     * @throws ResourceNotFoundException
     * @throws GuzzleException
     */
    public function deleteFile(string $containerName, string $fileName): bool
    {
        $response = $this->setter->deleteFile($containerName, $fileName);
        if (!$response->success) {
            if (isset($response->errors['404'])) {
                throw new ResourceNotFoundException($response->errors['404']);
            }

            throw new OpenStackException($response->errors['code']);
        }

        return true;
    }

    /**
     * @return string
     */
    protected function getterInterface(): string
    {
        return IGetFiles::class;
    }

    /**
     * @return string
     */
    protected function setterInterface(): string
    {
        return ISetFiles::class;
    }
}
