<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;

class FileController extends Controller
{
    public function uploadFile(StoreFileRequest $request, string $entityType, int $entityId)
    {
        $dir = match ($entityType) {
            'Company' => 'companies',
            'Procuration' => 'procurations',
            'Session' => 'sessions',
            default => null,
        };

        if ($dir === null) {
            setFlashMessage('error', 'نوع الكيان غير معروف.');
            return redirect()->back();
        }

        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $file) {
                $path = storeFile($file, "uploads/{$dir}", 'uploads');

                File::create([
                    'fileable_id' => $entityId,
                    'fileable_type' => "App\Models\\$entityType",
                    'path' => $path,
                ]);
            }
        }
        // else {
        //     setFlashMessage('error', 'لا يوجد صور من فضلك اضف صور');
        //     return redirect()->back();
        // }

        setFlashMessage('success', 'تم إضافة الملفات بنجاح.');

        return redirect()->back();
    }


    public function downloadFile(string $id)
    {
        $file = File::findOrFail($id);

        $filePath = public_path($file->path);

        if (!file_exists($filePath)) {
            setFlashMessage('error', 'الملف غير موجود.');
            return redirect()->back();
        }

        return response()->download($filePath);
    }
    public function destroyFile(string $id)
    {
        $file = File::findOrFail($id);

        deleteFile($file->path, 'uploads');

        $file->delete();

        setFlashMessage('success', 'تم حذف الملف بنجاح');

        return redirect()->back();
    }
}
