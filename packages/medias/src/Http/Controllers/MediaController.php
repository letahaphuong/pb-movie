<?php

namespace Package\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Package\Media\Services\FileService;

class MediaController extends Controller
{

    protected FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function uploadMedia(Request $request)
    {
        Log::info("Upload media");

        $file = $request->file('file');
        $this->fileService->validateFile($file);
        $storedKey = $this->fileService->uploadFile($file->getClientOriginalName(), $file->get());

        return response()->json([
            'stored_key' => $storedKey,
        ]);
    }
}
