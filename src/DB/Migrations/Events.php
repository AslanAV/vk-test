<?php

namespace App\DB\Migrations;

class Events extends Migration
{
    protected static string $nameDB = 'src/DB/db.sqlite';
    protected static string $nameTable = 'events';

    protected static $sql = "CREATE TABLE IF NOT EXISTS events (
                id INTEGER PRIMARY KEY, ip STRING, event_name STRING, auth BOOLEAN, created_at TIMESTAMP)";
}
