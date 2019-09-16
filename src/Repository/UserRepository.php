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

namespace App\Repository;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserRepository
 */
class UserRepository extends AbstractRepository implements UserLoaderInterface
{
    protected function getClassEntityName(): string
    {
        return User::class;
    }

    public function loadUserByUsername($identifier)
    {
        return $this->createQueryBuilder('u')
                    ->where('u.username = :identifier OR u.email = :identifier')
                    ->setParameter('identifier', $identifier)
                    ->getQuery()
                    ->getOneOrNullResult();
    }
}
