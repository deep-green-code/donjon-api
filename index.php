<?php

require 'vendor/autoload.php';

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteCreateTable as SQLiteCreateTable;

$pdo = (new SQLiteConnection())->connect();
if ($pdo != null) {
    echo 'Connected to the SQLite database successfully!\n';
} else {
    echo 'Whoops, could not connect to the SQLite database!\n';
    die;
}

$sqlite = new SQLiteCreateTable((new SQLiteConnection())->connect());
// create new tables
$sqlite->createTables();
// get the table list
$tables = $sqlite->getTableList();

echo "PHP SQLite CREATE TABLE Demo\n";
foreach ($tables as $table) {
    echo "- ".$table."\n";
}
