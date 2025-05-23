<?php

namespace SortedLinkedList\Service\TypeHandler;

use SortedLinkedList\SortedLinkedListInterface;

interface TypeHandlerInterface
{
    /**
     * Check if this handler can handle the given value type
     * @param mixed $value The value to check
     */
    public function canHandle($value): bool;

    /**
     * Get the sorted list in specified order
     * @param string $sort Order of sorting ("ASC" or "DESC")
     * @return array<int|string> Array of integer or string values
     */
    public function getValues(string $sort = "DESC"): array;

    /**
     * Add a value to the sorted list
     * @param mixed $value The value to add
     */
    public function addToList($value): void;

    /**
     * Remove a value from the sorted list
     * @param mixed $value The value to remove
     * @return void
     */
    public function removeFromList($value): void;

    /**
     * Flush all values from the sorted list
     */
    public function removeAll(): void;

    /**
     * Get the underlying sorted list instance
     * @return \SortedLinkedList\SortedLinkedListInterface
     */
    public function getSortedList(): SortedLinkedListInterface;
}
