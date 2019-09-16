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

use App\Responders\JsonResponder;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Exception\ValidatorException;

/**
 * Class ExceptionSubscriber
 */
class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onException',
        ];
    }

    public function onException(ExceptionEvent $event)
    {
        $exception = $event->getException();

        switch (get_class($exception)) {
            case ValidatorException::class:
                $event->setResponse(
                    JsonResponder::response($exception->getMessage(), $exception->getCode())
                );
                break;
        }
    }
}
