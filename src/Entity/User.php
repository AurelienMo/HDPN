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

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 *
 * @ORM\Table(name="amo_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends AbstractEntity implements UserInterface
{
    const LIST_GENDER = [
        1 => 'Mr',
        2 => 'Mme',
        3 => 'Mlle',
    ];

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    protected $roles;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $firstname;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $lastname;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $gender;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $securityPolicyAcceptedAt;

    /**
     * User constructor.
     *
     * @param string $username
     * @param string $email
     * @param string $password
     *
     * @throws \Exception
     */
    public function __construct(
        string $username,
        string $email,
        string $password
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->roles[] = 'ROLE_USER';
        $this->securityPolicyAcceptedAt = new DateTime();
        parent::__construct();
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
        return;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return !is_null($this->gender) ? self::LIST_GENDER[$this->gender] : null;
    }

    /**
     * @return DateTime
     */
    public function getSecurityPolicyAcceptedAt(): DateTime
    {
        return $this->securityPolicyAcceptedAt;
    }
}
