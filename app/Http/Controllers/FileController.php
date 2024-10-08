<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Support\Facades\DB;
use Exception;

class FileController extends Controller
{
    /**
     * Handle file upload based on entity type and ID.
     */
    public function uploadFile(StoreFileRequest $request, string $entityType, int $entityId)
    {
        $dir = $this->getDirectoryFromEntityType($entityType);

        if ($dir === null) {
            return $this->redirectWithMessage('error', 'نوع الكيان غير معروف.');
        }

        DB::beginTransaction();

        try {
            $uploadResult = FileService::uploadFiles($request, $dir, $entityId, $entityType);

            $messageType = $uploadResult === 0 ? 'warning' : 'success';
            $message = $uploadResult === 0 ? 'لم يتم رفع أي ملفات.' : 'تم إضافة الملفات بنجاح.';

            DB::commit();
            return $this->redirectWithMessage($messageType, $message);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->redirectWithMessage('error', 'فشل رفع الملف: ' . $e->getMessage());
        }
    }

    /**
     * Handle file download.
     */
    public function downloadFile(string $id)
    {
        try {
            $file = File::findOrFail($id);
            $filePath = public_path($file->path);

            if (!file_exists($filePath)) {
                return $this->redirectWithMessage('error', 'الملف غير موجود.');
            }

            return response()->download($filePath);
        } catch (Exception $e) {
            return $this->redirectWithMessage('error', 'فشل في تحميل الملف: ' . $e->getMessage());
        }
    }

    /**
     * Handle file deletion.
     */
    public function destroyFile(string $id)
    {
        try {
            $file = File::findOrFail($id);
            FileService::deleteFile($file->path, 'uploads');
            $file->delete();

            return $this->redirectWithMessage('success', 'تم حذف الملف بنجاح.');
        } catch (Exception $e) {
            return $this->redirectWithMessage('error', 'فشل حذف الملف: ' . $e->getMessage());
        }
    }

    /**
     * Get the directory name based on entity type.
     */
    private function getDirectoryFromEntityType(string $entityType): ?string
    {
        return match ($entityType) {
            'Company' => 'companies',
            'Procuration' => 'procurations',
            'Session' => 'sessions',
            default => null,
        };
    }

    /**
     * Redirect back with a flash message.
     */
    private function redirectWithMessage(string $type, string $message)
    {
        setFlashMessage($type, $message);
        return redirect()->back();
    }
}
