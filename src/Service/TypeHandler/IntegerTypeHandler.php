<?php

namespace SortedLinkedList\Service\TypeHandler;

use SortedLinkedList\IntegerSortedLinkedList;

final class IntegerTypeHandler extends AbstractTypeHandler
{
    public function __construct()
    {
        $this->list = new IntegerSortedLinkedList();
    }

    public function canHandle($value): bool
    {
        return is_int($value);
    }

    /**
     * Get the type of values stored in this list
     * @return string
     */
    public function getType(): string
    {
        return "integer";
    }
}
