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

use App\Entity\User;
use ReflectionClass;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class RequestInputSubscriber
 */
class RequestInputSubscriber implements EventSubscriberInterface
{
    /** @var SerializerInterface */
    protected $serializer;

    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /**
     * RequestInputSubscriber constructor.
     *
     * @param SerializerInterface   $serializer
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        SerializerInterface $serializer,
        TokenStorageInterface $tokenStorage
    ) {
        $this->serializer = $serializer;
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            RequestInputEvent::REQUEST_INPUT => 'onDeserializeRequest',
        ];
    }

    public function onDeserializeRequest(RequestInputEvent $event)
    {
        $input = !is_null($event->getContentRequest()) ?
            $this->serializer->deserialize(
                $event->getContentRequest(),
                $event->getInputClass(),
                'json'
            ) :
            $this->instanciateInput($event);

        $accessor = $this->getAccessor();
        foreach ($event->getPathRequestParams() as $key => $value) {
            if (property_exists($input, $key)) {
                $accessor->setValue($input, $key, $value);
            }
        }

        foreach ($event->getQueryRequestParams() as $key => $value) {
            if (property_exists($input, $key)) {
                $accessor->setValue($input, $key, $value);
            }
        }

        if (!is_null($this->tokenStorage->getToken()) && $this->tokenStorage->getToken()->getUser() instanceof User) {
            $accessor->setValue($input, 'owner', $this->tokenStorage->getToken()->getUser());
        }

        $event->setInput($input);
    }

    private function instanciateInput(RequestInputEvent $event)
    {
        $inputClass = new ReflectionClass($event->getInputClass());
        $className = $inputClass->name;

        return new $className();
    }

    private function getAccessor()
    {
        return new PropertyAccessor();
    }
}
