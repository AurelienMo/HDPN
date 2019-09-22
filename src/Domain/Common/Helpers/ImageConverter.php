<?php

declare(strict_types=1);

/*
 * This file is part of HDPN-be
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Common\Helpers;

use App\Domain\Common\ValueObject\Output\ImageConvert;

/**
 * Class ImageConverter
 */
final class ImageConverter
{
    public static function convertBase64ToImg($base64Img)
    {
        $data = explode(',', $base64Img);
        $format = explode(';', explode(':', $data[0])[1]);

        return new ImageConvert($format[0], $data[1]);
    }
}
