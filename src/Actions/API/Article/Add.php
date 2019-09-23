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

namespace App\Actions\API\Article;

use App\Domain\Article\Add\NewArticleInput;
use App\Domain\Common\Events\RequestInputEvent;
use App\Domain\Common\Events\ValidationEvent;
use App\Domain\Common\Helpers\ImageConverter;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Add
 *
 * @Route("/articles", name="add_article", methods={"POST"})
 */
class Add
{
    /** @var EventDispatcherInterface */
    protected $eventDispatcher;

    /**
     * Add constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param Request $request
     *
     */
    public function __invoke(Request $request)
    {
        /** @var RequestInputEvent $inputRequestEvent */
        $inputRequestEvent = $this->eventDispatcher->dispatch(
            new RequestInputEvent(NewArticleInput::class, $request->getContent())
        );
        $this->eventDispatcher->dispatch(
            new ValidationEvent($inputRequestEvent->getInput())
        );
        $this->eventDispatcher->dispatch(
            new NewArticleEvent($inputRequestEvent->getInput())
        );

        return new Response();
    }
}
