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

namespace App\Actions\API\Account;

use App\Domain\Account\Registration\RegistrationEvent;
use App\Domain\Account\Registration\RegistrationInput;
use App\Domain\Common\Events\RequestInputEvent;
use App\Domain\Common\Events\ValidationEvent;
use App\Responders\JsonResponder;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Create
 *
 * @Route("/account/anon/create", name="create_account", methods={"POST"})
 */
final class Create
{
    /** @var EventDispatcherInterface */
    protected $eventDispatcher;

    /**
     * Create constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(Request $request): Response
    {
        /** @var RequestInputEvent $inputEvent */
        $inputEvent = $this->eventDispatcher->dispatch(
            new RequestInputEvent(
                RegistrationInput::class,
                (string) $request->getContent(),
                $request->attributes->all(),
                $request->query->all()
            )
        );
        $this->eventDispatcher->dispatch(new ValidationEvent($inputEvent->getInput()));
        /** @var RegistrationInput $input */
        $input = $inputEvent->getInput();
        $this->eventDispatcher->dispatch(new RegistrationEvent($input));

        return JsonResponder::response(null, 201);
    }
}
