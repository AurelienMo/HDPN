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

use Doctrine\ORM\EntityManagerInterface;
use Nelmio\Alice\FileLoaderInterface;
use Nelmio\Alice\Loader\NativeLoader;

/**
 * Class LoaderNelmioAliceHelper
 */
final class LoaderNelmioAliceHelper
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /**
     * LoaderNelmioAliceHelper constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function load(string $file): void
    {
        $loader = self::getLoader();
        $objectSet = $loader->loadFile($file);

        foreach ($objectSet->getObjects() as $object) {
            $this->entityManager->persist($object);
        }

        $this->entityManager->flush();
    }

    private function getLoader(): FileLoaderInterface
    {
        return new NativeLoader();
    }
}
