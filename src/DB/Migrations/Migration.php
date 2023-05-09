<?php

namespace App\DB\Migrations;

class Migration
{
    public static function getNameDB()
    {
        return static::$nameDB;
    }

    public static function getNameTable()
    {
        return static::$nameTable;
    }

    public static function getMigration()
    {
        return static::$sql;
    }
}
