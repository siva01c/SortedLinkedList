<?php

namespace SortedLinkedList\Service\TypeHandler;

use SortedLinkedList\SortedLinkedListInterface;

abstract class AbstractTypeHandler implements TypeHandlerInterface
{
    protected SortedLinkedListInterface $list;

    /**
     * Get the sorted list in specified order
     * @param string $sort Order of sorting ('ASC' or 'DESC')
     * @return array<int|string>
     */
    public function getValues(string $sort = 'DESC'): array
    {
        return $this->list->getValues($sort);
    }

    public function getSortedList(): SortedLinkedListInterface
    {
        return $this->list;
    }

    /**
     * Remove a value from the sorted list
     * @param mixed $value The value to remove
     * @return void
     */
    public function removeFromList($value): void
    {
        $this->list->removeFromList($value);
    }

    /**
     * Remove all values from the sorted list
     */
    public function removeAll(): void
    {
        while ($this->list->getCount() > 0) {
            $values = $this->list->getValues();
            if (!empty($values)) {
                $this->removeFromList($values[0]);
            }
        }
    }

    /**
     * Get the number of items in the list
     * @return int
     */
    public function getCount(): int
    {
        return $this->list->getCount();
    }

    /**
     * Add a value to the sorted list
     * @param mixed $value The value to add
     */
    public function addToList($value): void
    {
        $this->list->addToList($value);
    }

    /**
     * Get the type of values stored in this list
     * @return string
     */
    abstract public function getType(): string;

    /**
     * Check if this handler can handle the given value type
     * @param mixed $value The value to check
     */
    abstract public function canHandle($value): bool;
}
