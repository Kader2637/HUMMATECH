<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Extending Class Helper for Image compressing system purpose with GD extension on PHP.
 *
 * @see https://www.php.net/manual/en/book.image.php
 * @see https://www.abstractapi.com/guides/how-to-compress-images-in-php
 * @see https://phppot.com/php/php-compress-image/
 * @package hummatech
 * @author cakadi190
 */
class ImageCompressing
{
    /**
     * Image Compressing action (but not copy the image)
     *
     * @param UploadedFile $request
     * @param string $targetPath
     * @param array{name:string, duplicate:bool, quality:int} $options The compress option
     * @return \Illuminate\Support\Collection<array-key, mixed>
     */
    public static function process(UploadedFile $request, string $targetPath, array $options = [])
    {
        $fileName = $options['name'] ?? Str::random(64);
        $originalFileExt = $request->getClientOriginalExtension();

        $uploadImage = $request->storeAs("public/{$targetPath}", "{$fileName}.{$originalFileExt}");
        $uploadedImagePath = str_replace("public/", "", $uploadImage);
        $compressTargetImage = public_path("storage/{$uploadedImagePath}");

        $options['targetPath'] = $targetPath;
        $options['name'] = $fileName;
        $options['extension'] = $originalFileExt;
        $options['original_uploaded_file'] = $compressTargetImage;

        $compressResult = self::processCompressImage($compressTargetImage, $options);

        return collect([
            ...$compressResult,
            ...$options,
        ]);
    }

    /**
     * Process image compressing
     *
     * @param string $imagePath
     * @param array $options
     */
    public static function processCompressImage(string $imagePath, array $options = [])
    {
        $imageInfo = self::getFileInfo($imagePath);
        if ($imageInfo['mime'] == 'image/gif') {
            $imageLayer = imagecreatefromgif($imagePath);
        } elseif ($imageInfo['mime'] == 'image/jpeg') {
            $imageLayer = imagecreatefromjpeg($imagePath);
        } elseif ($imageInfo['mime'] == 'image/png') {
            $imageLayer = imagecreatefrompng($imagePath);
        }

        $filename = "{$options['targetPath']}/{$options['name']}_compressed.jpg";
        $filePath = public_path("storage/{$filename}");
        $response = imagejpeg($imageLayer, $filePath, $options['quality'] ?? 50);

        if (!isset($options['duplicate']) || !$options['duplicate']) {
            unlink($options['original_uploaded_file']);
        }

        return [
            'filename' => $filename,
            'response' => $response,
        ];
    }

    /**
     * Getting file info
     *
     * @param UploadedFile $request
     * @return array
     */
    public static function getFileInfo(string $imageTarget)
    {
        return getimagesize($imageTarget);
    }
}
