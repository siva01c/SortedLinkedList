<?php

namespace SortedLinkedList;

class StringSortedLinkedList extends AbstractSortedLinkedList
{
    public function __construct()
    {
        $this->type = 'string';
    }

    /**
     * Get the type of values stored in this list
     * @return bool
     */
    protected function validateType(mixed $value): bool
    {
        return is_string($value);
    }

    /**
     * Compare two string values
     * @param mixed $a
     * @param mixed $b
     * @return int
     */
    protected function compare(mixed $a, mixed $b): int
    {
        return strcmp($a, $b);
    }
}
