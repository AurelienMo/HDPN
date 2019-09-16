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
 * Class RequestInputEvent
 */
class RequestInputEvent extends Event
{
    const REQUEST_INPUT = RequestInputEvent::class;

    /** @var string|null */
    protected $contentRequest;

    /** @var string */
    protected $inputClass;

    /** @var array */
    protected $pathRequestParams;

    /** @var array */
    protected $queryRequestParams;

    /** @var InputInterface */
    protected $input;

    public function __construct(
        string $inputClass,
        ?string $contentRequest = null,
        array $pathRequestParams = [],
        array $queryRequestParams = []
    ) {
        $this->inputClass = $inputClass;
        $this->pathRequestParams = $pathRequestParams;
        $this->queryRequestParams = $queryRequestParams;
        $this->contentRequest = $contentRequest;
    }

    /**
     * @return InputInterface
     */
    public function getInput(): InputInterface
    {
        return $this->input;
    }

    /**
     * @param InputInterface $input
     */
    public function setInput(InputInterface $input): void
    {
        $this->input = $input;
    }

    /**
     * @return string|null
     */
    public function getContentRequest(): ?string
    {
        return $this->contentRequest;
    }

    /**
     * @return string
     */
    public function getInputClass(): string
    {
        return $this->inputClass;
    }

    /**
     * @return array
     */
    public function getPathRequestParams(): array
    {
        return $this->pathRequestParams;
    }

    /**
     * @return array
     */
    public function getQueryRequestParams(): array
    {
        return $this->queryRequestParams;
    }
}
