// 1. CollectionInterface.php
<?php

interface CollectionInterface {
    public function add($element): bool;
    public function remove($element): bool;
    public function size(): int;
    public function isEmpty(): bool;
    public function clear(): void;
    public function contains($element): bool;
    public function toArray(): array;
}

?>

// 2. ListInterface.php
<?php

interface ListInterface extends CollectionInterface {
    public function get(int $index);
    public function set(int $index, $element): void;
    public function insert(int $index, $element): bool;
    public function removeAt(int $index);
    public function indexOf($element): int;
    public function lastIndexOf($element): int;
}

?>

// 3. QueueInterface.php
<?php

interface QueueInterface extends CollectionInterface {
    public function enqueue($element): bool;
    public function dequeue();
    public function peek();
    public function poll();
}

?>

// 4. MapInterface.php
<?php

interface MapInterface {
    public function put($key, $value);
    public function get($key);
    public function remove($key);
    public function containsKey($key): bool;
    public function containsValue($value): bool;
    public function size(): int;
    public function isEmpty(): bool;
    public function clear(): void;
    public function keys(): array;
    public function values(): array;
}

?>

// 5. IteratorInterface.php
<?php

interface IteratorInterface {
    public function hasNext(): bool;
    public function next();
    public function current();
    public function rewind(): void;
}

?>

// 6. ArrayList.php
<?php

class ArrayList implements ListInterface {
    private array $elements;
    private int $size;

    public function __construct() {
        $this->elements = [];
        $this->size = 0;
    }

    public function add($element): bool {
        $this->elements[] = $element;
        $this->size++;
        return true;
    }

    public function remove($element): bool {
        $index = $this->indexOf($element);
        if ($index !== -1) {
            return $this->removeAt($index) !== null;
        }
        return false;
    }

    public function size(): int {
        return $this->size;
    }

    public function isEmpty(): bool {
        return $this->size === 0;
    }

    public function clear(): void {
        $this->elements = [];
        $this->size = 0;
    }

    public function contains($element): bool {
        return $this->indexOf($element) !== -1;
    }

    public function toArray(): array {
        return $this->elements;
    }

    public function get(int $index) {
        if ($index < 0 || $index >= $this->size) {
            throw new OutOfBoundsException("Index out of bounds: $index");
        }
        return $this->elements[$index];
    }

    public function set(int $index, $element): void {
        if ($index < 0 || $index >= $this->size) {
            throw new OutOfBoundsException("Index out of bounds: $index");
        }
        $this->elements[$index] = $element;
    }

    public function insert(int $index, $element): bool {
        if ($index < 0 || $index > $this->size) {
            throw new OutOfBoundsException("Index out of bounds: $index");
        }
        array_splice($this->elements, $index, 0, [$element]);
        $this->size++;
        return true;
    }

    public function removeAt(int $index) {
        if ($index < 0 || $index >= $this->size) {
            throw new OutOfBoundsException("Index out of bounds: $index");
        }
        $removed = $this->elements[$index];
        array_splice($this->elements, $index, 1);
        $this->size--;
        return $removed;
    }

    public function indexOf($element): int {
        $index = array_search($element, $this->elements, true);
        return $index !== false ? $index : -1;
    }

    public function lastIndexOf($element): int {
        for ($i = $this->size - 1; $i >= 0; $i--) {
            if ($this->elements[$i] === $element) {
                return $i;
            }
        }
        return -1;
    }

    public function __toString(): string {
        return 'ArrayList: [' . implode(', ', $this->elements) . ']';
    }
}

?>

// 7. LinkedList.php
<?php

class LinkedList implements ListInterface {
    private ?Node $head;
    private int $size;

    public function __construct() {
        $this->head = null;
        $this->size = 0;
    }

    public function add($element): bool {
        $newNode = new Node($element);
        
        if ($this->head === null) {
            $this->head = $newNode;
        } else {
            $current = $this->head;
            while ($current->next !== null) {
                $current = $current->next;
            }
            $current->next = $newNode;
        }
        
        $this->size++;
        return true;
    }

    public function remove($element): bool {
        if ($this->head === null) {
            return false;
        }

        if ($this->head->data === $element) {
            $this->head = $this->head->next;
            $this->size--;
            return true;
        }

        $current = $this->head;
        while ($current->next !== null && $current->next->data !== $element) {
            $current = $current->next;
        }

        if ($current->next !== null) {
            $current->next = $current->next->next;
            $this->size--;
            return true;
        }

        return false;
    }

    public function size(): int {
        return $this->size;
    }

    public function isEmpty(): bool {
        return $this->size === 0;
    }

    public function clear(): void {
        $this->head = null;
        $this->size = 0;
    }

    public function contains($element): bool {
        return $this->indexOf($element) !== -1;
    }

    public function toArray(): array {
        $result = [];
        $current = $this->head;
        
        while ($current !== null) {
            $result[] = $current->data;
            $current = $current->next;
        }
        
        return $result;
    }

    public function get(int $index) {
        if ($index < 0 || $index >= $this->size) {
            throw new OutOfBoundsException("Index out of bounds: $index");
        }

        $current = $this->head;
        for ($i = 0; $i < $index; $i++) {
            $current = $current->next;
        }

        return $current->data;
    }

    public function set(int $index, $element): void {
        if ($index < 0 || $index >= $this->size) {
            throw new OutOfBoundsException("Index out of bounds: $index");
        }

        $current = $this->head;
        for ($i = 0; $i < $index; $i++) {
            $current = $current->next;
        }

        $current->data = $element;
    }

    public function insert(int $index, $element): bool {
        if ($index < 0 || $index > $this->size) {
            throw new OutOfBoundsException("Index out of bounds: $index");
        }

        $newNode = new Node($element);

        if ($index === 0) {
            $newNode->next = $this->head;
            $this->head = $newNode;
        } else {
            $current = $this->head;
            for ($i = 0; $i < $index - 1; $i++) {
                $current = $current->next;
            }
            $newNode->next = $current->next;
            $current->next = $newNode;
        }

        $this->size++;
        return true;
    }

    public function removeAt(int $index) {
        if ($index < 0 || $index >= $this->size) {
            throw new OutOfBoundsException("Index out of bounds: $index");
        }

        if ($index === 0) {
            $removed = $this->head->data;
            $this->head = $this->head->next;
        } else {
            $current = $this->head;
            for ($i = 0; $i < $index - 1; $i++) {
                $current = $current->next;
            }
            $removed = $current->next->data;
            $current->next = $current->next->next;
        }

        $this->size--;
        return $removed;
    }

    public function indexOf($element): int {
        $current = $this->head;
        $index = 0;
        
        while ($current !== null) {
            if ($current->data === $element) {
                return $index;
            }
            $current = $current->next;
            $index++;
        }
        
        return -1;
    }

    public function lastIndexOf($element): int {
        $current = $this->head;
        $lastIndex = -1;
        $index = 0;
        
        while ($current !== null) {
            if ($current->data === $element) {
                $lastIndex = $index;
            }
            $current = $current->next;
            $index++;
        }
        
        return $lastIndex;
    }

    public function __toString(): string {
        $elements = [];
        $current = $this->head;
        
        while ($current !== null) {
            $elements[] = $current->data;
            $current = $current->next;
        }
        
        return 'LinkedList: [' . implode(', ', $elements) . ']';
    }
}

class Node {
    public $data;
    public ?Node $next;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

?>

// 8. Stack.php
<?php

class Stack implements QueueInterface {
    private array $elements;
    private int $size;

    public function __construct() {
        $this->elements = [];
        $this->size = 0;
    }

    public function push($element): bool {
        return $this->enqueue($element);
    }

    public function pop() {
        return $this->dequeue();
    }

    public function peek() {
        return $this->poll();
    }

    public function enqueue($element): bool {
        $this->elements[] = $element;
        $this->size++;
        return true;
    }

    public function dequeue() {
        if ($this->isEmpty()) {
            throw new RuntimeException("Stack is empty");
        }
        $this->size--;
        return array_pop($this->elements);
    }

    public function poll() {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->elements[count($this->elements) - 1];
    }

    public function add($element): bool {
        return $this->enqueue($element);
    }

    public function remove($element): bool {
        $index = array_search($element, $this->elements, true);
        if ($index !== false) {
            array_splice($this->elements, $index, 1);
            $this->size--;
            return true;
        }
        return false;
    }

    public function size(): int {
        return $this->size;
    }

    public function isEmpty(): bool {
        return $this->size === 0;
    }

    public function clear(): void {
        $this->elements = [];
        $this->size = 0;
    }

    public function contains($element): bool {
        return in_array($element, $this->elements, true);
    }

    public function toArray(): array {
        return $this->elements;
    }

    public function __toString(): string {
        return 'Stack: [' . implode(', ', $this->elements) . ']';
    }
}

?>

// 9. Queue.php
<?php

class Queue implements QueueInterface {
    private array $elements;
    private int $size;

    public function __construct() {
        $this->elements = [];
        $this->size = 0;
    }

    public function enqueue($element): bool {
        $this->elements[] = $element;
        $this->size++;
        return true;
    }

    public function dequeue() {
        if ($this->isEmpty()) {
            throw new RuntimeException("Queue is empty");
        }
        $this->size--;
        return array_shift($this->elements);
    }

    public function peek() {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->elements[0];
    }

    public function poll() {
        return $this->peek();
    }

    public function add($element): bool {
        return $this->enqueue($element);
    }

    public function remove($element): bool {
        $index = array_search($element, $this->elements, true);
        if ($index !== false) {
            array_splice($this->elements, $index, 1);
            $this->size--;
            return true;
        }
        return false;
    }

    public function size(): int {
        return $this->size;
    }

    public function isEmpty(): bool {
        return $this->size === 0;
    }

    public function clear(): void {
        $this->elements = [];
        $this->size = 0;
    }

    public function contains($element): bool {
        return in_array($element, $this->elements, true);
    }

    public function toArray(): array {
        return $this->elements;
    }

    public function __toString(): string {
        return 'Queue: [' . implode(', ', $this->elements) . ']';
    }
}

?>

// 10. HashMap.php
<?php

class HashMap implements MapInterface {
    private array $buckets;
    private int $size;
    private int $capacity;

    public function __construct(int $capacity = 16) {
        $this->capacity = $capacity;
        $this->buckets = array_fill(0, $capacity, []);
        $this->size = 0;
    }

    private function hash($key): int {
        return crc32(strval($key)) % $this->capacity;
    }

    public function put($key, $value) {
        $index = $this->hash($key);
        
        foreach ($this->buckets[$index] as &$pair) {
            if ($pair[0] === $key) {
                $oldValue = $pair[1];
                $pair[1] = $value;
                return $oldValue;
            }
        }
        
        $this->buckets[$index][] = [$key, $value];
        $this->size++;
        return null;
    }

    public function get($key) {
        $index = $this->hash($key);
        
        foreach ($this->buckets[$index] as $pair) {
            if ($pair[0] === $key) {
                return $pair[1];
            }
        }
        
        return null;
    }

    public function remove($key) {
        $index = $this->hash($key);
        
        foreach ($this->buckets[$index] as $i => $pair) {
            if ($pair[0] === $key) {
                $removedValue = $pair[1];
                array_splice($this->buckets[$index], $i, 1);
                $this->size--;
                return $removedValue;
            }
        }
        
        return null;
    }

    public function containsKey($key): bool {
        return $this->get($key) !== null;
    }

    public function containsValue($value): bool {
        foreach ($this->buckets as $bucket) {
            foreach ($bucket as $pair) {
                if ($pair[1] === $value) {
                    return true;
                }
            }
        }
        return false;
    }

    public function size(): int {
        return $this->size;
    }

    public function isEmpty(): bool {
        return $this->size === 0;
    }

    public function clear(): void {
        $this->buckets = array_fill(0, $this->capacity, []);
        $this->size = 0;
    }

    public function keys(): array {
        $keys = [];
        foreach ($this->buckets as $bucket) {
            foreach ($bucket as $pair) {
                $keys[] = $pair[0];
            }
        }
        return $keys;
    }

    public function values(): array {
        $values = [];
        foreach ($this->buckets as $bucket) {
            foreach ($bucket as $pair) {
                $values[] = $pair[1];
            }
        }
        return $values;
    }

    public function __toString(): string {
        $pairs = [];
        foreach ($this->buckets as $bucket) {
            foreach ($bucket as $pair) {
                $pairs[] = "{$pair[0]} => {$pair[1]}";
            }
        }
        return 'HashMap: {' . implode(', ', $pairs) . '}';
    }
}

?>
