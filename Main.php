<?php

// wajib include terlebih dahulu 
require_once 'CollectionInterface.php';
require_once 'ListInterface.php';
require_once 'QueueInterface.php';
require_once 'MapInterface.php';
require_once 'IteratorInterface.php';
require_once 'ArrayList.php';
require_once 'LinkedList.php';
require_once 'Stack.php';
require_once 'Queue.php';
require_once 'HashMap.php';

class TugasUTS {
    
    public static function jalankan() {
        echo "=== TUGAS STRUKTUR DATA - UTS ===\n\n";
        echo "Nama: Budi Santoso\n";
        echo "NIM: 123456789\n";
        echo "Kelas: TI-2024-A\n\n";
        
        // panggil method test
        self::testArrayList();
        self::testLinkedList(); 
        self::testStack();
        self::testQueue();
        self::testHashMap();
        
        echo "\n=== SELESAI ===\n";
    }
    
    // nomor 1 - test array list
    private static function testArrayList() {
        echo "1. TEST ARRAY LIST:\n";
        
        // buat objek array list
        $listBuah = new ArrayList();
        
        // tambah data buah
        $listBuah->add("Apel");
        $listBuah->add("Jeruk");
        $listBuah->add("Mangga");
        $listBuah->insert(1, "Pisang"); // sisipkan di tengah
        
        // tampilkan
        echo "List buah: " . $listBuah . "\n";
        echo "Jumlah data: " . $listBuah->size() . "\n";
        echo "Data index ke-2: " . $listBuah->get(2) . "\n";
        
        // cari data
        $cari = "Jeruk";
        if ($listBuah->contains($cari)) {
            echo "Ketemu nih '$cari' di list\n";
        } else {
            echo "Ga ada '$cari' di list\n";
        }
        
        // hapus data
        $listBuah->remove("Jeruk");
        echo "Setelah hapus Jeruk: " . $listBuah . "\n\n";
    }
    
    // nomor 2 - test linked list  
    private static function testLinkedList() {
        echo "2. TEST LINKED LIST:\n";
        
        $listAngka = new LinkedList();
        
        // masukin angka
        $listAngka->add(100);
        $listAngka->add(200);
        $listAngka->add(300);
        $listAngka->insert(1, 150); // tambah di tengah
        
        echo $listAngka . "\n";
        echo "Total angka: " . $listAngka->size() . "\n";
        echo "Angka pertama: " . $listAngka->get(0) . "\n";
        
        // cari posisi angka 150
        $posisi = $listAngka->indexOf(150);
        echo "Angka 150 ada di index: " . $posisi . "\n";
        
        // hapus angka di tengah
        $listAngka->removeAt(2);
        echo "Setelah hapus index 2: " . $listAngka . "\n\n";
    }
    
    // nomor 3 - test stack (tumpukan)
    private static function testStack() {
        echo "3. TEST STACK (TUMPUKAN):\n";
        
        $tumpukan = new Stack();
        
        // masukin data ke stack
        $tumpukan->push("Buku 1");
        $tumpukan->push("Buku 2"); 
        $tumpukan->push("Buku 3");
        
        echo $tumpukan . "\n";
        echo "Yang paling atas: " . $tumpukan->peek() . "\n";
        
        // ambil dari stack
        $ambil = $tumpukan->pop();
        echo "Yang diambil: " . $ambil . "\n";
        echo "Sisa tumpukan: " . $tumpukan . "\n\n";
    }
    
    // nomor 4 - test queue (antrian)
    private static function testQueue() {
        echo "4. TEST QUEUE (ANTRIAN):\n";
        
        $antrian = new Queue();
        
        // antri masuk
        $antrian->enqueue("Orang 1");
        $antrian->enqueue("Orang 2");
        $antrian->enqueue("Orang 3");
        
        echo $antrian . "\n";
        echo "Yang paling depan: " . $antrian->peek() . "\n";
        
        // panggil dari antrian
        $panggil = $antrian->dequeue();
        echo "Yang dipanggil: " . $panggil . "\n";
        echo "Sisa antrian: " . $antrian . "\n\n";
    }
    
    // nomor 5 - test hash map
    private static function testHashMap() {
        echo "5. TEST HASH MAP:\n";
        
        $dataMahasiswa = new HashMap();
        
        // input data
        $dataMahasiswa->put("nama", "Budi Santoso");
        $dataMahasiswa->put("nim", "123456789");
        $dataMahasiswa->put("jurusan", "Teknik Informatika");
        $dataMahasiswa->put("ipk", 3.75); // update nilai
        
        echo $dataMahasiswa . "\n";
        echo "Banyak data: " . $dataMahasiswa->size() . "\n";
        echo "Nama: " . $dataMahasiswa->get("nama") . "\n";
        
        // cek data
        if ($dataMahasiswa->containsKey("jurusan")) {
            echo "Data jurusan ada\n";
        }
        
        // hapus data
        $dataMahasiswa->remove("ipk");
        echo "Setelah hapus IPK: " . $dataMahasiswa . "\n";
        
        // tampilkan semua kunci dan nilai
        echo "Kunci: " . implode(', ', $dataMahasiswa->keys()) . "\n";
        echo "Nilai: " . implode(', ', $dataMahasiswa->values()) . "\n";
    }
}

// jalankan program
TugasUTS::jalankan();

?>
