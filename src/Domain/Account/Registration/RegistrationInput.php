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

namespace App\Domain\Account\Registration;

use App\Domain\Common\Validators\UniqueInput;
use App\Domain\Common\ValueObject\Input\InputInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RegistrationInput
 *
 * @UniqueInput(
 *     class="App\Entity\User",
 *     fields={"username", "email"},
 *     message="Utilisateur déjà existant."
 * )
 */
class RegistrationInput implements InputInterface
{
    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="Le nom d'utilisateur est requis."
     * )
     */
    protected $username;

    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="L'adresse email est requise."
     * )
     * @Assert\Email(
     *     message="Le format de l'adresse email n'est pas valide."
     * )
     */
    protected $email;

    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="Le mot de passe est requis."
     * )
     * @Assert\Length(
     *     min="8",
     *     minMessage="Le mot de passe doit faire 8 caractères minimum."
     * )
     */
    protected $password;

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }
}
