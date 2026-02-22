<?php

namespace App\Http\Services;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
class ImageService
{

    public static function uploadWithEncoding(UploadedFile $image,string $path, ?int $width = null, ?string $format = null)
    {
        $format = $format ?? $image->extension();
        $image = Image::read($image);

        if ($width)
        {
            $image = $image->scaleDown($width);
        }

        $image = $image->encodeByExtension($format, quality:80);

        $filename = Str::uuid() . '.' . $format;
        $fullpath = trim($path, '/') . '/' . $filename;

        Storage::disk('public')->put($fullpath, $image);

        return $fullpath;

    }

    public static function uploadWithoutEncoding(UploadedFile $image,string $path, ?int $width = null)
    {
        $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $path = trim($path, '/');

        Storage::disk('public')->putFileAS($path, $image, $fileName);
        return $path . "/" . $fileName;
    }
}
