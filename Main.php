<?php

require_once 'autoload.php';

class TugasStrukdat {
    
    public static function main() {
        echo "=================================\n";
        echo "TUGAS BESAR STRUKTUR DATA\n";
        echo "Collection Framework PHP\n";
        echo "=================================\n\n";
        
        // jalanin semua test
        self::ujiCobaArrayList();
        self::ujiCobaLinkedList();
        self::ujiCobaStack();
        self::ujiCobaQueue();
        self::ujiCobaHashMap();
        
        echo "\n=================================\n";
        echo "TERIMA KASIH\n";
        echo "=================================\n";
    }
    
    private static function ujiCobaArrayList() {
        echo "1. UJI COBA ARRAY LIST\n";
        echo "-----------------------\n";
        
        $list = new ArrayList();
        
        // tambah data
        $list->add("Data 1");
        $list->add("Data 2");
        $list->add("Data 3");
        $list->insert(1, "Data 1.5");
        
        echo "Isi list: " . $list . "\n";
        echo "Size: " . $list->size() . "\n";
        echo "Get index 0: " . $list->get(0) . "\n";
        
        // test 
        if ($list->contains("Data 2")) {
            echo "Data 2 ada dalam list\n";
        }
        
        $list->remove("Data 2");
        echo "Setelah remove Data 2: " . $list . "\n\n";
    }
    
    private static function ujiCobaLinkedList() {
        echo "2. UJI COBA LINKED LIST\n";
        echo "-------------------------\n";
        
        $list = new LinkedList();
        
        $list->add(100);
        $list->add(200);
        $list->add(300);
        $list->insert(1, 150);
        
        echo "Isi linked list: " . $list . "\n";
        echo "Size: " . $list->size() . "\n";
        echo "Index of 150: " . $list->indexOf(150) . "\n";
        
        $list->removeAt(1);
        echo "Setelah remove index 1: " . $list . "\n\n";
    }
    
    private static function ujiCobaStack() {
        echo "3. UJI COBA STACK\n";
        echo "------------------\n";
        
        $stack = new Stack();
        
        $stack->push("Item 1");
        $stack->push("Item 2");
        $stack->push("Item 3");
        
        echo "Stack: " . $stack . "\n";
        echo "Peek: " . $stack->peek() . "\n";
        echo "Pop: " . $stack->pop() . "\n";
        echo "Stack sekarang: " . $stack . "\n\n";
    }
    
    private static function ujiCobaQueue() {
        echo "4. UJI COBA QUEUE\n";
        echo "------------------\n";
        
        $queue = new Queue();
        
        $queue->enqueue("Pasien 1");
        $queue->enqueue("Pasien 2");
        $queue->enqueue("Pasien 3");
        
        echo "Queue: " . $queue . "\n";
        echo "Peek: " . $queue->peek() . "\n";
        echo "Dequeue: " . $queue->dequeue() . "\n";
        echo "Queue sekarang: " . $queue . "\n\n";
    }
    
    private static function ujiCobaHashMap() {
        echo "5. UJI COBA HASH MAP\n";
        echo "---------------------\n";
        
        $map = new HashMap();
        
        $map->put("nama", "Bahlil ETANHOL");
        $map->put("nim", "H1H025067");
        $map->put("matkul", "Struktur Data");
        
        echo "Hash Map: " . $map . "\n";
        echo "Size: " . $map->size() . "\n";
        echo "Get nim: " . $map->get("nim") . "\n";
        
        $map->remove("matkul");
        echo "Setelah remove matkul: " . $map . "\n";
        echo "Keys: " . implode(", ", $map->keys()) . "\n";
    }
}

// jalanin program
TugasStrukdat::main();

?>
