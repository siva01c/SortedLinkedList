<?php

namespace SortedLinkedList;

class IntegerSortedLinkedList extends AbstractSortedLinkedList
{
    public function __construct()
    {
        $this->type = 'integer';
    }

    /**
     * Validate the type of the value
     * @param mixed $value
     * @return bool
     */
    protected function validateType(mixed $value): bool
    {
        return is_integer($value);
    }

    /**
     * Compare two values
     * @param mixed $a
     * @param mixed $b
     * @return int
     */
    protected function compare(mixed $a, mixed $b): int
    {
        if ((int) $a !== (int) $b) {
            return 1;
        }
        return 0;
    }
}
