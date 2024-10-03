<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Support\Facades\DB;
use Exception;

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

        DB::beginTransaction();

        try {
            $uploadResult = FileService::uploadFiles($request, $dir, $entityId, $entityType);

            if ($uploadResult === 0) {
                setFlashMessage('warning', 'لم يتم رفع أي ملفات.');
            } else {
                setFlashMessage('success', 'تم إضافة الملفات بنجاح.');
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            setFlashMessage('error', 'فشل رفع الملف');
            return redirect()->back()->withInput();
        }

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

        FileService::deleteFile($file->path, 'uploads');

        $file->delete();

        setFlashMessage('success', 'تم حذف الملف بنجاح');

        return redirect()->back();
    }
}
