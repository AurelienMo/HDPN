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

namespace App\Domain\Common\Events;

use App\Domain\Common\ValueObject\Input\InputInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class ValidationEvent
 */
class ValidationEvent extends Event
{
    const VALIDATION = ValidationEvent::class;

    /** @var InputInterface */
    protected $input;

    /**
     * ValidationEvent constructor.
     *
     * @param InputInterface $input
     */
    public function __construct(
        InputInterface $input
    ) {
        $this->input = $input;
    }

    /**
     * @return InputInterface
     */
    public function getInput(): InputInterface
    {
        return $this->input;
    }
}
