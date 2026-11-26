
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = new SQLite3(__DIR__ . '/sales.db');
$db->busyTimeout(5000);

$db->exec("CREATE TABLE IF NOT EXISTS sales (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    product_name TEXT NOT NULL,
    price REAL NOT NULL,
    quantity INTEGER NOT NULL,
    total REAL NOT NULL,
    sale_date DATETIME DEFAULT CURRENT_TIMESTAMP
)");
?>
