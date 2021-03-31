<?php

namespace App\Asset;

class ImageHandler
{
    /**
     * @param array $fileData
     * @param string $uploadDir
     * @return array
     */
    public static function upload(array $fileData, string $uploadDir): array
    {
        if ($fileData['error'] !== 0) return ['error' => '', 'file_name' => ''];

        $fileExtension = pathinfo($fileData['name'], PATHINFO_EXTENSION);

        if (!in_array($fileExtension, ['gif', 'jpg', 'jpeg', 'png'])) {
            return [
                'error' => 'The file type is not accepted.',
                'file_name' => ''
            ];
        }

        // 5Mb = 5000000
        if ($fileData['size'] > 5000000) {
            return [
                'error' => 'The file size exceeds the maximum allowed size.',
                'file_name' => ''
            ];
        }

        $newFileName = time() . '.' . $fileExtension;

        if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

        if (move_uploaded_file($fileData['tmp_name'], $uploadDir . $newFileName)) {
            return [
                'error' => '',
                'file_name' => $newFileName
            ];
        } else {
            return [
                'error' => 'The file could not be sent due to an internal server error.',
                'file_name' => ''
            ];
        }
    }

    /**
     * @param string $fileName
     * @param string $uploadDir
     * @return void
     */
    public static function createThumb(string $fileName, string $uploadDir): void
    {
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        $path = $uploadDir . $fileName;

        switch ($fileExtension) {
            case 'gif':
                $src = imagecreatefromgif($path);
                break;
            case 'jpg':
            case 'jpeg':
                $src = imagecreatefromjpeg($path);
                break;
            case 'png':
                $src = imagecreatefrompng($path);
                break;
        }

        $srcWidth  = imagesx($src);
        $srcHeight = imagesy($src);

        $ratio      = 400 / $srcWidth;
        $thumbWidth  = 400;
        $thumbHeight = $srcHeight * $ratio;

        if ($thumbHeight > 400) {
            $ratio      = 400 / $srcHeight;
            $thumbWidth  = $srcWidth * $ratio;
            $thumbHeight = 400;
        }

        $temp = imagecreatetruecolor($thumbWidth, $thumbHeight);

        if ($fileExtension === 'png') {
            imagesavealpha($temp, true);
            $alpha = imagecolorallocatealpha($temp, 0, 0, 255, 127);
            imagecolortransparent($temp, $alpha);
            imagefill($temp, 0, 0, $alpha);
        }

        imagecopyresampled($temp, $src, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $srcWidth, $srcHeight);

        $thumbFile = $uploadDir . pathinfo($fileName, PATHINFO_FILENAME) . '-min.' . $fileExtension;

        switch ($fileExtension) {
            case 'gif':
                imagegif($temp, $thumbFile);
                break;
            case 'jpg':
            case 'jpeg':
                imagejpeg($temp, $thumbFile, 100);
                break;
            case 'png':
                imagepng($temp, $thumbFile);
                break;
        }
    }
}
