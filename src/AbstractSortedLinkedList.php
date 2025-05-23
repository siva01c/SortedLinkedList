<?php

namespace SortedLinkedList;

use SortedLinkedList\SortedLinkedListInterface;
use SortedLinkedList\LinkedListItem;

abstract class AbstractSortedLinkedList implements SortedLinkedListInterface
{
    protected int $count = 0;
    /** 
     * Array of list items
     * @var array<int, LinkedListItem> */
    protected array $values = [];

    /**
     * The type of the sorted list
     * @var string
     */
    protected string $type;

    /**
     * Compare two values and return:
     * negative if $a < $b
     * zero if $a == $b
     * positive if $a > $b
     * @param mixed $a
     * @param mixed $b
     */
    abstract protected function compare(mixed $a, mixed $b): int;
 
    /**
     * @param mixed $value
     */
    abstract protected function validateType($value): bool;

    /**
     * Get the number of items in the list
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Get the type of the sorted list
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the sorted list in specified order
     * @param string $sort Order of sorting ("ASC" or "DESC")
     * @return array<int|string> Array of integer or string values
     */
    public function getValues(string $sort = "DESC"): array
    {
        $result = [];
        foreach ($this->values as $item) {
            if ($item instanceof LinkedListItem) {
                $result[] = $item->value;
            }
        }

        if ($sort === "ASC") {
            return array_reverse($result);
        }

        return $result;
    }

    /**
     * Add a value to the sorted list
     * @param mixed $value The value to add
     */
    public function addToList($value): void
    {
        if (!$this->validateType($value)) {
            throw new \InvalidArgumentException("Invalid value type for this list type");
        }
        $newItem = new LinkedListItem($value);
        if ($this->count === 0) {
            $this->values[] = $newItem;
        } else {
            $inserted = false;
            foreach ($this->values as $key => $item) {
                if ($this->compare($item->value, $newItem->value) > 0) {
                    array_splice($this->values, $key, 0, [$newItem]);
                    $inserted = true;
                    break;
                }
            }
            if (!$inserted) {
                $this->values[] = $newItem;
            }
        }
        $this->count++;
    }

    /**
     * Remove a value from the sorted list
     * @param mixed $value The value to remove
     */
    public function removeFromList($value): void
    {
        foreach ($this->values as $key => $item) {
            if ($item->value === $value) {
                unset($this->values[$key]);
                $this->count--;
                return;
            }
        }
        trigger_error("Value not found in list", E_USER_NOTICE);
    }

    /**
     * Remove all values from the sorted list
     */
    public function removeAll(): void
    {
        $this->values = [];
        $this->count = 0;
    }
}
