<?php

namespace Package\Media\Services;

use Illuminate\Support\Facades\Log;
use Package\Media\Repositories\MediaRepository;

class MediaService
{
    protected MediaRepository $mediaRepository;
    protected FileService $fileService;

    public function __construct(MediaRepository $mediaRepository,
                                FileService     $fileService)
    {
        $this->mediaRepository = $mediaRepository;
        $this->fileService = $fileService;
    }

    public function saveMedia($attribute)
    {
        Log::info("Save media with fileName {$attribute['stored_key']},
                                           movieId #{$attribute['movie_id']},
                                           and type #{$attribute['source_type']}");

        if (empty($attribute['stored_key'])) {
            return;
        }

        $this->mediaRepository->create($attribute);
        $this->fileService->saveFile($attribute['stored_key']);
    }
}
