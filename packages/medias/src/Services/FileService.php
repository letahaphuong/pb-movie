<?php

namespace Package\Media\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileService
{
    protected const FILE_NAME_PATTERN = '%s_%s.%s';
    protected const LENGTH_OF_RANDOM_STRING = 30;
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


    public function uploadFile($fileName, $fileContent)
    {
        Log::info("Upload file #{$fileName}");

        return $this->upload($this->generateFileName($fileName), $this->tempDirMinio, $fileContent);
    }

    public function saveFile($fileName)
    {
        Log::info("Save file {$fileName}");

        if ($this->invalidFileName($fileName)) {
            return null;
        }

        $this->validateExtension($fileName, pathinfo($fileName, PATHINFO_EXTENSION));
        $this->moveFile($this->tempDirMinio, $fileName);
    }

    private function moveFile($sourceDir, $fileName)
    {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $extensionImage = ['jpg', 'jpeg', 'png'];
        $extensionFilm = ['mp4'];
        $destinationDir = null;

        if (in_array($extension, $extensionImage)) {
            $destinationDir = $this->workingDirMinioImages;
        }
        if (in_array($extension, $extensionFilm)) {
            $destinationDir = $this->workingDirMinioVideos;
        }

        $this->copyFile($sourceDir, $fileName, $destinationDir, $fileName);
        $this->deleteFile($this->tempDirMinio, $fileName);
    }

    private function copyFile($sourceDir, $originalPath, $targetDir, $destinationPath)
    {
        try {
            $sourceKey = $this->makeObjectRequestKey($sourceDir, $originalPath);
            $destinationKey = $this->makeObjectRequestKey($targetDir, $destinationPath);

            $this->storage::cloud()->copy($sourceKey, $destinationKey);
        } catch (Exception $e) {
            Log::error('Copy failed: ' . $e->getMessage());

            throw new FileException('Copy failed', 0, $e);
        }
    }

    private function validateExtension($fileName, $extensions)
    {
        $fileExtension = Str::lower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!collect($extensions)->contains(fn($extension) => Str::lower($extension) === $fileExtension)) {
            throw new FileException("Invalid extension");
        }
    }

    public function validateFile($file)
    {
        if (!$file) {
            throw new FileException("File not found");
        }
        $fileName = $file->getClientOriginalName();
        if (empty($fileName)) {
            throw new FileException("Invalid file name");
        }

        $allowedExtensions = ['mp4', 'jpg', 'jpeg', 'png'];

        if (!in_array($file->extension(), $allowedExtensions)) {
            throw new FileException('File extension is not allowed');
        }
    }

    private function deleteFile($dir, $fileName)
    {
        try {
            $key = $this->makeObjectRequestKey($dir, $fileName);

            $this->storage::cloud()->delete($key);
        } catch (Exception $e) {
            Log::error('Delete failed: ' . $e->getMessage());

            throw new FileException('Delete failed', 0, $e);
        }
    }

    private function upload($fileName, $targetDir, $fileContent)
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

        return str_starts_with($key, '/') ? substr($key, 1) : $key;
    }

    function generateFileName($originalFilename)
    {
        $randomString = bin2hex(random_bytes(self::LENGTH_OF_RANDOM_STRING));
        $timestamp = round(microtime(true) * 1000);
        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);

        return sprintf(self::FILE_NAME_PATTERN, $randomString, $timestamp, $extension);
    }

    private function invalidFileName($fileName)
    {
        return empty($fileName) || Str::startsWith($fileName, 'http');
    }
}
