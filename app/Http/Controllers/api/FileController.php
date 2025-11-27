<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function uploadFile(FileRequest $request) {

        $disk = $request->input('is_private', 0) ? 'private' : 'public';

        $filePath = Storage::disk($disk)->putFile($request->input('path'), $request->file('file'));

        return response()->json(
            ResponseFormatter::success(
                'File uploaded successfully',
                [
                    'path' => $filePath,
                    'url' => Storage::disk($disk)->url($filePath)
                ]
            )
        );

    }
    public function downloadFile(Request $request) {

        $filePath = Storage::disk('private')->path($request->input('file_path'));
        return response()->download($filePath);

        return response()->download(storage_path('app/private/' . $request->input('file_path')));
    }
}
