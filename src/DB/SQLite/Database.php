<?php

namespace App\DB\SQLite;

use App\DB\Migrations\Events;
use SQLite3;

class Database
{
    public function getConnection(): SQLite3
   {
       $db = new SQLite3(Events::getNameDB());

       $db->query(Events::getMigration());
       return $db;
   }

   public function getTableName(): string
   {
       return Events::getNameTable();
   }
}
