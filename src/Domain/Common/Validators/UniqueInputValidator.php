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

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class UniqueInputValidator
 */
class UniqueInputValidator extends ConstraintValidator
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }
    public function validate(
        $value,
        Constraint $constraint
    ) {
        if (!$constraint instanceof UniqueInput) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\UniqueEntityInput');
        }
        if (null === $value || '' === $value) {
            return;
        }
        $fields = (array) $constraint->fields;
        $accessor = new PropertyAccessor();
        foreach ($fields as $name) {
            $fieldValue = $accessor->getValue($value, $name);
            $object = $this->entityManager->getRepository($constraint->class)
                                          ->findOneBy(
                                              [
                                                  $name => $fieldValue,
                                              ]
                                          );
            if ($object && $this->context->getViolations()->count() === 0) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
    }
}
