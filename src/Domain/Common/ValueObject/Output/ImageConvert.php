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

namespace App\Domain\Common\ValueObject\Output;

/**
 * Class ImageConvert
 */
class ImageConvert implements OutputInterface
{
    /** @var string */
    protected $format;

    /** @var string */
    protected $data;

    /**
     * ImageConvert constructor.
     *
     * @param string $format
     * @param string $data
     */
    public function __construct(
        string $format,
        string $data
    ) {
        $this->format = $format;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }
}
