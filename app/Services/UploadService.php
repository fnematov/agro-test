<?php

namespace App\Services;


use Illuminate\Http\UploadedFile;

class UploadService
{
    public function uploadFileAndGetName(UploadedFile $file = null): ?string
    {
        return $file?->store('images', ['disk' => 'public']);
    }

    public function uploadFilesAndGetNames(array $items, $key = null): array
    {
        foreach ($items as $k => $item) {
            $items[$key ?? $k] = $this->uploadFileAndGetName($items[$key ?? $k]);
        }
        return $items;
    }
}
