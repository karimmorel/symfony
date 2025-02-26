<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\TypeInfo\Type;

use Symfony\Component\TypeInfo\Exception\LogicException;
use Symfony\Component\TypeInfo\Type;

/**
 * Represents a template placeholder, such as "T" in "Collection<T>".
 *
 * @author Mathias Arlaud <mathias.arlaud@gmail.com>
 * @author Baptiste Leduc <baptiste.leduc@gmail.com>
 */
final class TemplateType extends Type
{
    public function __construct(
        private readonly string $name,
        private readonly Type $bound,
    ) {
    }

    public function getBaseType(): BuiltinType|ObjectType
    {
        throw new LogicException(sprintf('Cannot get base type on "%s" template type.', $this));
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBound(): Type
    {
        return $this->bound;
    }

    public function asNonNullable(): self
    {
        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
