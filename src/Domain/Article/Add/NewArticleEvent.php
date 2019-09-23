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

namespace App\Domain\Article\Add;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class NewArticleEvent
 */
class NewArticleEvent extends Event
{
    const NEW_ARTICLE = NewArticleEvent::class;

    /** @var NewArticleInput */
    protected $input;

    /**
     * NewArticleEvent constructor.
     *
     * @param NewArticleInput $input
     */
    public function __construct(
        NewArticleInput $input
    ) {
        $this->input = $input;
    }

    /**
     * @return NewArticleInput
     */
    public function getInput(): NewArticleInput
    {
        return $this->input;
    }
}
