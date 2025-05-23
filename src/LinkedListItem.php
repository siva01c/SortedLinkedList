<?php

namespace SortedLinkedList;

class LinkedListItem
{
    /**
     * @var int|string
     */
    public mixed $value;
    public string $type;
    public ?LinkedListItem $item = null;

    /**
     * List item constructor
     * @param mixed $value
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
        $this->type = gettype($value);
    }
}
