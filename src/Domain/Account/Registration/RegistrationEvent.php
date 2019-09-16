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

use App\Domain\Common\ValueObject\Input\InputInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class RegistrationEvent
 */
class RegistrationEvent extends Event
{
    const REGISTRATION = RegistrationEvent::class;

    /** @var RegistrationInput */
    protected $input;

    /**
     * RegistrationEvent constructor.
     *
     * @param RegistrationInput $input
     */
    public function __construct(
        RegistrationInput $input
    ) {
        $this->input = $input;
    }

    /**
     * @return RegistrationInput
     */
    public function getInput(): RegistrationInput
    {
        return $this->input;
    }
}
