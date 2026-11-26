<?php
$db = new SQLite3("sales.db");

$db->exec("CREATE TABLE IF NOT EXISTS sales (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    product_name TEXT NOT NULL,
    price REAL NOT NULL,
    quantity INTEGER NOT NULL,
    total REAL NOT NULL,
    sale_date DATETIME DEFAULT CURRENT_TIMESTAMP
)");
?>