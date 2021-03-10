<?php

namespace App\Asset;

class ImageUploader
{
    /**
     * @param array $fileData
     * @param string $uploadDir
     * @return array
     */
    public static function upload(array $fileData, string $uploadDir): array
    {
        if ($fileData['error'] === 0) {
            if (in_array($fileData['type'], ['image/gif', 'image/jpeg', 'image/png'])) {
                $fileExtension = '.' . explode('/', $fileData['type'])[1];
                $newFileName = time() . $fileExtension;
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                if (move_uploaded_file($fileData['tmp_name'], $uploadDir . $newFileName)) {


                    // Création de miniature
                    $path = $uploadDir . $newFileName;

                    switch ($fileExtension) {
                        case '.jpeg':
                            $src = imagecreatefromjpeg($path);
                            break;
                        case '.png':
                            $src = imagecreatefrompng($path);
                            break;
                        case '.gif':
                            $src = imagecreatefromgif($path);
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

                    if ($fileExtension == '.png') {
                        imagesavealpha($temp, true);
                        $alpha = imagecolorallocatealpha($temp, 0, 0, 255, 127);
                        imagecolortransparent($temp, $alpha);
                        imagefill($temp, 0, 0, $alpha);
                    }

                    imagecopyresampled($temp, $src, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $srcWidth, $srcHeight);

                    $thumbFile = $uploadDir . pathinfo($newFileName, PATHINFO_FILENAME) . '-min' . $fileExtension;

                    switch ($fileExtension) {
                        case '.jpeg':
                            imagejpeg($temp, $thumbFile, 100);
                            break;
                        case '.png':
                            imagepng($temp, $thumbFile);
                            break;
                        case '.gif':
                            imagegif($temp, $thumbFile);
                            break;
                    }


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
            } else {
                return [
                    'error' => 'The file type is not accepted.',
                    'file_name' => ''
                ];
            }
        } else {
            return ['error' => '', 'file_name' => ''];
        }
    }
}
