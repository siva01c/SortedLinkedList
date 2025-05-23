<?php

namespace SortedLinkedList;

interface SortedLinkedListInterface
{
    /**
     * Add a value to the sorted list
     * @param mixed $value The value to add to the list
     */
    public function addToList($value): void;

    /**
     * Get the number of items in the list
     * @return int
     */
    public function getCount(): int;

    /**
     * Get the type of values stored in this list
     * @return string
     */
    public function getType(): string;

    /**
     * Get the sorted list in specified order
     * @param string $sort Order of sorting ("ASC" or "DESC")
     * @return array<int|string> Array of values
     */
    public function getValues(string $sort = "DESC"): array;

    /**
     * Remove a value from the sorted list
     * @param mixed $value The value to remove from the list
     */
    public function removeFromList($value): void;

    /**
     * Remove all values from the sorted list
     */
    public function removeAll(): void;
}
