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

namespace App\Responders;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class JsonResponder
 */
class JsonResponder
{
    public static function response(
        ?string $datas = null,
        int $statusCode = Response::HTTP_OK,
        array $additionalHeader = []
    ) {
        return new Response(
            $datas,
            $statusCode,
            array_merge(
                [
                    'Content-Type' => 'application/json',
                ],
                $additionalHeader
            )
        );
    }
}
