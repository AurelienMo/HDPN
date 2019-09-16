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

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ValidationSubscriber
 */
class ValidationSubscriber implements EventSubscriberInterface
{
    /** @var ValidatorInterface */
    protected $validator;

    /**
     * ValidationSubscriber constructor.
     *
     * @param ValidatorInterface $validator
     */
    public function __construct(
        ValidatorInterface $validator
    ) {
        $this->validator = $validator;
    }

    public static function getSubscribedEvents()
    {
        return [
            ValidationEvent::VALIDATION => 'onValidate',
        ];
    }

    public function onValidate(ValidationEvent $event)
    {
        $errorsList = $this->validator->validate($event->getInput());
        if (count($errorsList) > 0) {
            $errors = [];
            /** @var ConstraintViolationInterface $violation */
            foreach ($errorsList as $violation) {
                $errors[$violation->getPropertyPath()][] = $violation->getMessage();
            }

            throw new ValidatorException(
                (string) json_encode($errors),
                400
            );
        }
    }
}
