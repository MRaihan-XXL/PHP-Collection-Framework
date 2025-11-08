<?php

// function buat load class otomatis
spl_autoload_register(function($className) {
    // list file yang perlu diload
    $files = [
        'CollectionInterface.php',
        'ListInterface.php', 
        'QueueInterface.php',
        'MapInterface.php',
        'IteratorInterface.php',
        'ArrayList.php',
        'LinkedList.php',
        'Stack.php',
        'Queue.php',
        'HashMap.php'
    ];
    
    // ngecek file
    if (in_array($className . '.php', $files)) {
        if (file_exists($className . '.php')) {
            require_once $className . '.php';
        }
    }
});

// kalau yang di atas error
function loadManual() {
    $requiredFiles = [
        'CollectionInterface',
        'ListInterface',
        'QueueInterface', 
        'MapInterface',
        'IteratorInterface',
        'ArrayList',
        'LinkedList',
        'Stack',
        'Queue',
        'HashMap'
    ];
    
    foreach ($requiredFiles as $file) {
        if (file_exists($file . '.php')) {
            require_once $file . '.php';
        } else {
            // kalo file gak ketemu
            echo "<!-- Warning: File $file.php tidak ditemukan -->\n";
        }
    }
}

// panggil function load manual buat jaga-jaga aja
loadManual();

echo "<!-- Autoload berhasil dijalankan -->\n";

?>
