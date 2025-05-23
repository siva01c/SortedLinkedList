# Sorted Linked Lists

This is a library for sorting values into lists based on value type. Currently, there are only two TypeHandlers: **integer** and **string**.
If you need to sort another data type, create a TypeHandler for your data type.

### How to Use:

`composer require siva01/sorted-linked-list`

**Example code:**

```php
use SortedLinkedList\Service\ListSorterService;

$sorter = new ListSorterService();
$sorter->addToList(1);
$sorter->addToList("Apple");

$integerList = $sorter->loadList('integer');
$intValues = $integerList->getValues('ASC');

$stringList = $sorter->loadList('string');
$stringValues = $stringList->getValues('ASC');
```

More examples can be found in: `/docs/examples/basic_usage.php`

### Composer Commands

* `composer cs` – Code style checks
* `composer test` – Unit tests
* `composer analyse` – PHPStan analysis


