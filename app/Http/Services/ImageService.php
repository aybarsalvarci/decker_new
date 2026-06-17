<?php

namespace App\Http\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{

    public static function upload(UploadedFile $image, string $path, ?int $width = null, ?string $format = null)
    {
        $format = $format ?? $image->extension();
        $image = Image::read($image);

        if ($width) {
            $image = $image->scaleDown($width);
        }

        $image = $image->sharpen(12)
            ->encodeByExtension($format, quality: 80);

        $filename = Str::uuid() . '.' . $format;
        $fullpath = trim($path, '/') . '/' . $filename;

        Storage::disk('public')->put($fullpath, $image);

        return $fullpath;

    }

    public static function uploadWithEncoding(UploadedFile $image, string $path, ?int $width = null, ?string $format = null)
    {
        $format = $format ?? $image->extension();
        $image = Image::read($image);

        if ($width) {
            $image = $image->scaleDown($width);
        }

        $image = $image->sharpen(12)
            ->encodeByExtension($format, quality: 80);

        $filename = Str::uuid() . '.' . $format;
        $fullpath = trim($path, '/') . '/' . $filename;

        Storage::disk('public')->put($fullpath, $image);

        return $fullpath;

    }

    public static function uploadWithoutEncoding(UploadedFile $image, string $path, ?int $width = null)
    {
        $format = strtolower($image->getClientOriginalExtension());
        $fileName = Str::uuid() . '.' . $format;
        $fullpath = trim($path, '/') . '/' . $fileName;

        if (in_array($format, ['ico', 'svg'])) {
            Storage::disk('public')->putFileAs(trim($path, '/'), $image, $fileName);
            return trim($path, '/') . "/" . $fileName;
        }

        $img = Image::read($image);

        if ($width) {
            $img = $img->scaleDown($width);
        }

        $encodedImage = $img->sharpen(12)
            ->encodeByExtension($format, quality: 80);

        Storage::disk('public')->put($fullpath, $encodedImage);

        return trim($path, '/') . "/" . $fileName;
    }
}
