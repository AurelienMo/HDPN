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

use App\Entity\User;
use App\Repository\UserRepository;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class RegistrationSubscriber
 */
class RegistrationSubscriber implements EventSubscriberInterface
{
    /** @var EncoderFactoryInterface */
    protected $encoderFactory;

    /** @var UserRepository */
    protected $userRepo;

    /**
     * RegistrationSubscriber constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     * @param UserRepository          $userRepo
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        UserRepository $userRepo
    ) {
        $this->encoderFactory = $encoderFactory;
        $this->userRepo = $userRepo;
    }

    public static function getSubscribedEvents()
    {
        return [
            RegistrationEvent::REGISTRATION => 'onRegistration',
        ];
    }

    public function onRegistration(RegistrationEvent $event)
    {
        $encoder = $this->encoderFactory->getEncoder(User::class);
        $user = User::create(
            $event->getInput(),
            $encoder->encodePassword((string) $event->getInput()->getPassword(), '')
        );

        $this->userRepo->persist($user);
        $this->userRepo->flush();
    }
}
