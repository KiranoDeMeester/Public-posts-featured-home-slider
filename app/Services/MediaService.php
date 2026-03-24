<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    /**
     * De constructor injecteert de ImageProcessorService.
     * Dit is een 'SOLID' oplossing: Separation of Concerns.
     */
    public function __construct(
        protected ImageProcessorService $imageProcessor
    ) {}

    /**
     * Upload een nieuwe afbeelding, verwerk deze via Intervention en koppel aan model
     */
    public function upload($model, UploadedFile $file, ?string $directory = null): Media
    {
        $disk = 'public';

        // 1. Genereer een unieke bestandsnaam (we forceren .jpg vanwege de conversie)
        $hashName = $file->hashName();
        $filename = pathinfo($hashName, PATHINFO_FILENAME) . '.jpg';
        $targetPath = $directory ? $directory . '/' . $filename : $filename;

        // 2. Verwerk de afbeelding met de ImageProcessorService (Resizing & Optimalisatie)
        $processedImageData = $this->imageProcessor->process($file);

        // 3. Sla de bewerkte binaire data op de schijf op
        Storage::disk($disk)->put($targetPath, $processedImageData);

        // 4. Maak het Media record aan in de database
        $media = new Media([
            'disk' => $disk,
            'directory' => $directory,
            'filename' => $filename,
            'mime_type' => 'image/jpeg',
            'size' => Storage::disk($disk)->size($targetPath),
        ]);

        $model->media()->save($media);

        return $media;
    }

    /**
     * Vervang een bestaande afbeelding
     */
    public function replace($model, UploadedFile $file, ?string $directory = null): Media
    {
        if ($model->media) {
            $this->deleteFile($model->media);
            $model->media->delete();
        }

        return $this->upload($model, $file, $directory);
    }

    /**
     * Verwijder enkel de fysieke file van de schijf
     */
    public function deleteFile(Media $media): void
    {
        $path = $media->path();

        if (Storage::disk($media->disk)->exists($path)) {
            Storage::disk($media->disk)->delete($path);
        }
    }

    /**
     * Volledige verwijdering: file én database record
     */
    public function delete(Media $media): void
    {
        $this->deleteFile($media);
        $media->delete();
    }
}
