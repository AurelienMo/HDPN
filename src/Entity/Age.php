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

namespace App\Entity;

use App\Entity\Traits\NameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Age
 *
 * @ORM\Table(name="amo_age")
 * @ORM\Entity()
 */
class Age extends AbstractEntity
{
    use NameTrait;

    public function __construct(
        string $name
    ) {
        $this->name = $name;
        parent::__construct();
    }
}
