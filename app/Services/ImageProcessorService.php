<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageProcessorService
{
    protected ImageManager $manager;

    public function __construct()
    {
        // We initialiseren de manager met de GD driver
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Verwerk de afbeelding: resize en converteer naar JPEG
     */
    public function process(UploadedFile $file, int $width = 1200): string
    {
        $image = $this->manager->read($file);

        // Pas de grootte aan (behoud ratio, vergroot niet als het kleiner is)
        $image->scaleDown(width: $width);

        // Return de raw data als een geoptimaliseerde JPEG
        return (string) $image->toJpeg(80);
    }
}
