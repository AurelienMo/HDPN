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
 * Class TypeOtherContact
 *
 * @ORM\Table(name="amo_type_other_contact")
 * @ORM\Entity(repositoryClass="App\Repository\TypeOtherContactRepository")
 */
class TypeOtherContact extends AbstractEntity
{
    use NameTrait;

    public function __construct(
        string $name
    ) {
        $this->name = $name;
        parent::__construct();
    }

    public static function create(string $name)
    {
        return new self($name);
    }
}
