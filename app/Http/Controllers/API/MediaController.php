<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Service\FileService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
        $storedKey = $this->fileService->uploadFile($file->getClientOriginalName(), $file->get(), $file->getSize());

        return response()->json([
            'stored_key' => $storedKey,
        ]);
    }
}
