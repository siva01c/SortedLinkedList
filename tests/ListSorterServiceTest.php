<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use SortedLinkedList\Exception\UnsupportedTypeException;
use SortedLinkedList\Service\ListSorterService;
use SortedLinkedList\SortedLinkedListInterface;

class ListSorterServiceTest extends TestCase
{
    private ListSorterService $sorterService;

    protected function setUp(): void
    {
        $this->sorterService = new ListSorterService();
    }

    public function testAddToListWithIntegerValue(): void
    {
        $this->sorterService->addToList(42);
        $integerList = $this->sorterService->loadList('integer');
        $this->assertInstanceOf(SortedLinkedListInterface::class, $integerList);
        $this->assertContains(42, $integerList->getValues());
        $this->sorterService->removeFromList(42);
        $this->assertNotContains(42, $integerList->getValues());
    }

    public function testAddToListWithStringValue(): void
    {
        $this->sorterService->addToList("Test");
        $textList = $this->sorterService->loadList('string');
        $this->assertInstanceOf(SortedLinkedListInterface::class, $textList);
        $this->assertContains("Test", $textList->getValues());
        $this->sorterService->removeFromList("Test");
        $this->assertNotContains("Test", $textList->getValues());
    }

    public function testAddToListWithUnsupportedType(): void
    {
        $this->expectException(UnsupportedTypeException::class);
        $this->expectExceptionMessage("No handler found for value type: object");
        $this->sorterService->addToList(new \stdClass());
        $this->expectException(UnsupportedTypeException::class);
        $this->expectExceptionMessage("No handler found for value type: object");
        $this->sorterService->addToList(3.5);
    }

    public function testAddToListMixedValues(): void
    {
        $this->sorterService->addToList("Test3");
        $this->sorterService->addToList(42);
        $textList = $this->sorterService->loadList('string');
        $integerList = $this->sorterService->loadList('integer');
        $this->assertContains("Test3", $textList->getValues(), "String value should be in text list");
        $this->assertContains(42, $integerList->getValues(), "Integer value should be in integer list");
    }

    public function testGetCount(): void
    {
        $this->sorterService->addToList("Test1");
        $this->sorterService->addToList(42);
        $this->sorterService->addToList("Test2");
        $this->sorterService->addToList(24);
        $this->assertEquals(4, $this->sorterService->getCount(), "Total count should be 4 (2 strings + 2 numbers)");
    }

    public function testRemoveFromList(): void
    {
        $this->sorterService->addToList("Test");
        $this->sorterService->removeFromList("Test");
        $textList = $this->sorterService->loadList('string');
        $this->assertNotContains("Test", $textList->getValues(), "String value should be removed from text list");
    }

    public function testRemoveAll(): void
    {
        $this->sorterService->addToList("Test1");
        $this->sorterService->addToList(42);
        $this->sorterService->removeAll();
        $textList = $this->sorterService->loadList('string');
        $integerList = $this->sorterService->loadList('integer');
        $this->assertEquals(0, $textList->getCount(), "Text list should be empty after removeAll");
        $this->assertEquals(0, $integerList->getCount(), "Integer list should be empty after removeAll");
    }
}
