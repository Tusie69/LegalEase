<?php
$start = microtime(true);
try {
    $pdo = new PDO(
        'mysql:host=127.0.0.1;port=3306;dbname=legalease_2',
        'root',
        '',
        [PDO::ATTR_TIMEOUT => 5, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $row = $pdo->query('SELECT 1 AS ok')->fetch(PDO::FETCH_ASSOC);
    echo 'PDO_OK ' . $row['ok'] . PHP_EOL;
} catch (Throwable $e) {
    echo 'PDO_ERR ' . $e->getMessage() . PHP_EOL;
}
echo 'ELAPSED=' . round(microtime(true) - $start, 2) . PHP_EOL;
