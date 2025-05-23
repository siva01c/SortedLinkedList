<?php

namespace SortedLinkedList\Service;

use SortedLinkedList\Exception\UnsupportedTypeException;
use SortedLinkedList\Service\TypeHandler\TypeHandlerInterface;
use SortedLinkedList\SortedLinkedListInterface;

class ListSorterService
{
    /** @var TypeHandlerInterface[] */
    private array $handlers = [];

    public function __construct()
    {
        $this->loadHandlers();
    }

    /**
     * Automatically load and register all TypeHandler classes from the TypeHandler directory
     */
    private function loadHandlers(): void
    {
        $handlerDirectory = __DIR__ . '/TypeHandler';
        $files = glob($handlerDirectory . '/*.php');

        if ($files === false) {
            return;
        }

        foreach ($files as $file) {
            $className = basename($file, '.php');
            if ($className === 'TypeHandlerInterface' || $className === 'AbstractTypeHandler') {
                continue;
            }

            /** @var class-string<TypeHandlerInterface> */
            $fullyQualifiedClassName = 'SortedLinkedList\\Service\\TypeHandler\\' . $className;

            if (!class_exists($fullyQualifiedClassName)) {
                continue;
            }

            $reflection = new \ReflectionClass($fullyQualifiedClassName);

            if (
                $reflection->isFinal()
                && !$reflection->isAbstract()
                && $reflection->implementsInterface(TypeHandlerInterface::class)
            ) {
                /** @var TypeHandlerInterface */
                $handler = new $fullyQualifiedClassName();
                $this->registerHandler($handler);
            }
        }
    }

    public function registerHandler(TypeHandlerInterface $handler): void
    {
        $this->handlers[] = $handler;
    }

    /**
     * Add a value to the appropriate list based on its type
     * @param mixed $value The value to add
     * @throws UnsupportedTypeException if no handler is found for the value type
     */
    public function addToList($value): void
    {
        foreach ($this->handlers as $handler) {
            if ($handler->canHandle($value)) {
                $handler->addToList($value);
                return;
            }
        }

        throw new UnsupportedTypeException("No handler found for value type: " . gettype($value));
    }

    /**
     * Remove all values from all lists
     */
    public function removeAll(): void
    {
        /** @var TypeHandlerInterface $handler */
        foreach ($this->handlers as $handler) {
            $handler->removeAll();
        }
    }

    /**
     * Remove a value from the appropriate list
     * @param mixed $value The value to remove
     * @throws \SortedLinkedList\Exception\UnsupportedTypeException if no handler is found for the value type
     */
    public function removeFromList($value): void
    {
        foreach ($this->handlers as $handler) {
            if ($handler->canHandle($value)) {
                $handler->removeFromList($value);
                return;
            }
        }

        throw new UnsupportedTypeException("No handler found for value type: " . gettype($value));
    }

    /**
     * Get the sorted list for the specified type
     * @param string $type Type of list to retrieve ('integer','string')
     * @return SortedLinkedListInterface
     * @throws UnsupportedTypeException if no handler is found for the type
     */
    public function loadList(string $type): SortedLinkedListInterface
    {
        foreach ($this->handlers as $handler) {
            if (($handler instanceof TypeHandlerInterface) && $handler->getSortedList()->getType() === $type) {
                return $handler->getSortedList();
            }
        }
        throw new UnsupportedTypeException("No handler found for type: " . $type);
    }

    /**
     * Get the total count of items across all lists
     * @return int
     */
    public function getCount(): int
    {
        $count = 0;
        foreach ($this->handlers as $handler) {
            if ($handler instanceof TypeHandlerInterface) {
                $count += $handler->getSortedList()->getCount();
            }
        }
        return $count;
    }
}
