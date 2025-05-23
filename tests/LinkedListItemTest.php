<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use SortedLinkedList\LinkedListItem;

class LinkedListItemTest extends TestCase
{
    public function testCreateWithInteger(): void
    {
        $item = new LinkedListItem(5);
        $this->assertEquals(5, $item->value);
        $this->assertEquals('integer', $item->type);
        $this->assertNull($item->item);
    }

    public function testCreateWithString(): void
    {
        $item = new LinkedListItem("TestString");
        $this->assertEquals("TestString", $item->value);
        $this->assertEquals('string', $item->type);
        $this->assertNull($item->item);
    }
}
