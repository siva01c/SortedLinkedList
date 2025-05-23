<?php

namespace SortedLinkedList;

use SortedLinkedList\SortedLinkedListInterface;
use SortedLinkedList\LinkedListItem;

abstract class AbstractSortedLinkedList implements SortedLinkedListInterface
{
    protected int $count = 0;
    /** @var array<int, LinkedListItem> */
    protected array $values = [];
    protected string $type;

    /**
     * @param mixed $value
     */
    abstract protected function validateType($value): bool;

    public function getCount(): int
    {
        return $this->count;
    }

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
                if (strcmp((string)$item->value, (string)$newItem->value) > 0) {
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
