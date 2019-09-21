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
 * Class OtherContact
 *
 * @ORM\Table(name="amo_other_contact")
 * @ORM\Entity(repositoryClass="App\Repository\OtherContactRepository")
 */
class OtherContact extends AbstractEntity
{
    /**
     * @var TypeOtherContact
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeOtherContact")
     * @ORM\JoinColumn(name="amo_type_other_contact_id", referencedColumnName="id")
     */
    protected $typeContact;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="amo_user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $value;

    public function __construct(
        User $user,
        TypeOtherContact $typeContact,
        string $value
    ) {
        $this->user = $user;
        $this->typeContact = $typeContact;
        $this->value = $value;
        parent::__construct();
    }

    /**
     * @return TypeOtherContact
     */
    public function getTypeContact(): TypeOtherContact
    {
        return $this->typeContact;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
