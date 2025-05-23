<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use SortedLinkedList\Service\ListSorterService;

// Create a new list sorter service
$sorter = new ListSorterService();

// Add mixed values
echo "\n<h2>Add items:\n" . "</h2>";
$sorter->addToList(99);
$sorter->addToList(9);
$sorter->addToList(1);
$sorter->addToList("Apple");
$sorter->addToList("Orange");
$sorter->addToList("Banana");


// Get integer list
$integerList = $sorter->loadList('integer');
echo "Integers (DESC): " . implode(', ', $integerList->getValues()) . PHP_EOL . "<br>";
echo "Integers (ASC): " . implode(', ', $integerList->getValues('ASC')) . PHP_EOL . "<br>";

// Get string list
$stringList = $sorter->loadList('string');
echo "Strings (DESC): " . implode(', ', $stringList->getValues()) . PHP_EOL . "<br>";
echo "Strings (ASC): " . implode(', ', $stringList->getValues('ASC')) . PHP_EOL . "<br>";

// Count items
echo "Integer count: " . $integerList->getCount() . PHP_EOL . "<br>";
echo "String count: " . $stringList->getCount() . PHP_EOL . "<br>";

// Remove some items
$sorter->removeFromList(23);
$sorter->removeFromList("PHP");

echo "\nAfter removal:\n" . "<br>";
echo "Integers: " . implode(', ', $integerList->getValues()) . PHP_EOL . "<br>";
echo "Strings: " . implode(', ', $stringList->getValues()) . PHP_EOL . "<br>";

// Remove all
$sorter->removeAll();

echo "\nRemove all:\n" . "<br>";
echo "Integers: " . implode(', ', $integerList->getValues()) . PHP_EOL . "<br>";
echo "Strings: " . implode(', ', $stringList->getValues()) . PHP_EOL . "<br>";