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

namespace App\Domain\Common\ValueObject\Input;

use App\Entity\User;

/**
 * Interface AuthoredInputInterface
 */
interface AuthoredInputInterface extends InputInterface
{
    public function getOwner(): User;

    public function setOwner(User $user): void;
}
