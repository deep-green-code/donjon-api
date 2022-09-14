<?php

namespace App;

/**
 * SQLite Create Table Demo
 */
class SQLiteCreateTable
{
    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * connect to the SQLite database
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * create tables
     */
    public function createTables()
    {
        $commands = [
            'CREATE TABLE IF NOT EXISTS viewer (
                viewer_name  VARCHAR (255) PRIMARY KEY,
                viewer_title TEXT,
                viewer_kill INTEGER DEFAULT 0,
                viewer_streak INTEGER DEFAULT 0,
                viewer_last_init DATETIME
            )',
            'CREATE TABLE IF NOT EXISTS mob_list (
                mob_id INTEGER PRIMARY KEY,
                mob_name  VARCHAR (255) NOT NULL,
                mob_pv INTEGER NOT NULL,
                mob_img TEXT,
            )',
            'CREATE TABLE IF NOT EXISTS mob_histo (
                histo_id INTEGER PRIMARY KEY,
                histo_mob_id  VARCHAR (255) NOT NULL,
                histo_mob_pv INTEGER NOT NULL,
                histo_date_spawn TEXT,
                histo_date_update TEXT,
                histo_date_death TEXT,
            )'
        ];
        // execute the sql commands to create new tables
        foreach ($commands as $command) {
            $this->pdo->exec($command);
        }
    }

    /**
     * get the table list in the database
     */
    public function getTableList()
    {
        $stmt = $this->pdo->query("SELECT name
                                   FROM sqlite_master
                                   WHERE type = 'table'
                                   ORDER BY name");
        $tables = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tables[] = $row['name'];
        }

        return $tables;
    }
}
