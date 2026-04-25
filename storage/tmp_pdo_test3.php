<?php
$start = microtime(true);
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=legalease_2','root','');
    echo "CONNECTED\n";
} catch (Throwable $e) {
    echo 'ERR: ' . $e->getMessage() . "\n";
}
echo 'ELAPSED=' . round(microtime(true)-$start,2) . "\n";
