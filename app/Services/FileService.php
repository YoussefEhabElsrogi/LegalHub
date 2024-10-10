<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\File;

class FileService
{
    private static function storeFile($file, $directory, $disk = 'uploads')
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $extension;
        return $file->storeAs($directory, $fileName, $disk);
    }

    public static function deleteFile($path, $disk = 'uploads')
    {
        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
            return true;
        }
        return false;
    }

    public static function uploadFiles(Request $request, string $directory, int $entityId, string $entityType)
    {
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $fileData = [];
            $dir = "uploads/$directory";

            foreach ($files as $file) {
                $path = self::storeFile($file, $dir);
                $fileData[] = [
                    'fileable_id' => $entityId,
                    'fileable_type' => "App\Models\\$entityType",
                    'path' => $path,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $inserted = File::insert($fileData);

            return count($fileData);
        }

        return 0;
    }
}
