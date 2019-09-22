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

use App\Domain\Common\Helpers\ImageConverter;
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
    /**
     * @param Request $request
     *
     */
    public function __invoke(Request $request)
    {
        return new Response();
    }
}
