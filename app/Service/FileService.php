<?php

namespace App\Service;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileService
{
    protected const FILE_NAME_PATTERN = '%s_%s.%s';
    protected const LENGTH_OF_RANDOM_STRING = 30;
    private $config;
    protected $workingDirMinioVideos = 'working-videos';
    protected $workingDirMinioImages = 'working-images';
    protected $tempDirMinio = 'temp';
    protected $bucketNameMinio = 'pb-movie';
    protected $contentType = 'image/jpeg';
    protected $endPoint = 'http://localhost:9000';
    protected Storage $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }


    public function uploadFile($fileName, $fileContent, $size)
    {
        Log::debug("Upload file #{$fileName}");
        return $this->upload($this->generateFileName($fileName), $this->tempDirMinio, $fileContent, $size);
    }


    public function validateFile($uploadFile)
    {
        if (!$uploadFile) {
            throw new FileException("File not found");
        }

        $fileName = $uploadFile->getClientOriginalName();

        if (empty($fileName)) {
            throw new FileException("Invalid file name");
        }

        $allowedExtensions = ['mp4', 'jpg', 'jpeg'];

        if (!in_array($uploadFile->extension(), $allowedExtensions)) {
            throw new FileException('File extension is not allowed');
        }

    }

    private function upload($fileName, $targetDir, $fileContent, $size)
    {
        if ($this->invalidFileName($fileName) || is_null($fileContent)) {
            return null;
        }

        try {
            $key = $this->makeObjectRequestKey($targetDir, $fileName);

            $this->storage::cloud()->put($key, $fileContent);

            return $fileName;
        } catch (Exception $e) {
            Log::error('Upload failed: ' . $e->getMessage());
            throw new FileException("Upload failed", $e->getCode());
        }
    }

    private function makeObjectRequestKey($dir, $fileName)
    {
        $key = empty($dir) ? $fileName : $dir . '/' . $fileName;
        return substr($key, 0, 1) === '/' ? substr($key, 1) : $key;
    }

    private function invalidFileName($fileName)
    {
        return empty($fileName) || strpos($fileName, "http") === 0;
    }

    function generateFileName($originalFilename)
    {

        $randomString = bin2hex(random_bytes(self::LENGTH_OF_RANDOM_STRING));

        $timestamp = round(microtime(true) * 1000);

        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);

        return sprintf(self::FILE_NAME_PATTERN, $randomString, $timestamp, $extension);
    }
}

