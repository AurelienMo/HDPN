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

use App\Entity\AbstractEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class AbstractRepository
 */
abstract class AbstractRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry
    ) {
        parent::__construct(
            $registry,
            $this->getClassEntityName()
        );
    }

    abstract protected function getClassEntityName(): string;

    public function persist(AbstractEntity $entity)
    {
        $this->_em->persist($entity);
    }

    public function flush()
    {
        $this->_em->flush();
    }

    public function remove(AbstractEntity $entity)
    {
        $this->_em->remove($entity);
    }
}
