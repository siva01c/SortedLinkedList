<?php

namespace SortedLinkedList\Service\TypeHandler;

use SortedLinkedList\StringSortedLinkedList;

final class StringTypeHandler extends AbstractTypeHandler
{
    public function __construct()
    {
        $this->list = new StringSortedLinkedList();
    }

    public function canHandle($value): bool
    {
        return is_string($value);
    }

    /**
     * Get the type of values stored in this list
     * @return string
     */
    public function getType(): string
    {
        return "string";
    }
}
