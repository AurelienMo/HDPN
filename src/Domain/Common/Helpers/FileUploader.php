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
use App\Entity\User;

/**
 * Class FileUploader
 */
final class FileUploader
{
    const ARTICLE = 'articles';
    const USER = 'users';

    /** @var string */
    protected $fileFolder;

    /**
     * FileUploader constructor.
     *
     * @param string $fileFolder
     */
    public function __construct(
        string $fileFolder
    ) {
        $this->fileFolder = $fileFolder;
    }

    public function uploadImage(User $user, ImageConvert $imageConvert, string $type): string
    {
        $filepath = sprintf(
            '%s/%s/%s/%s.%s',
            $this->fileFolder,
            $user->getUsername(),
            $type,
            md5(uniqid()),
            explode('/', $imageConvert->getFormat())[1]
        );
        fopen($filepath, 'wb');
        fwrite($filepath, $imageConvert->getData());
        fclose($filepath);

        return $filepath;
    }
}
