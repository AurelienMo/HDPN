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

namespace App\Domain\Common\Validators;

use Symfony\Component\Validator\Constraint;

/**
 * Class ValidEntityInput
 *
 * @Annotation
 */
class ValidEntityInput extends Constraint
{
    public $message;
    public $class;
}
