<?php

namespace App\Controllers;

use App\Application\Requests\EventRequest;
use App\Application\Requests\GetEventsRequest;
use App\DB\SQLite\Database;
use Carbon\Carbon;

class EventController
{
    public static function create(EventRequest $request): bool|string
    {
        if (!$request->isValidatedData()) {
            http_response_code(400);
            return json_encode("Bad Request", JSON_THROW_ON_ERROR);
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $event = $request->getBody()['event']['name'];
        $isAuth = $request->getBody()['auth'];
        $created_at = Carbon::now();

        $newConnection = new Database();
        $db = $newConnection->getConnection();

        $sql = "INSERT INTO events (ip, event_name, auth, created_at) VALUES ('{$ip}', '{$event}', '{$isAuth}', '{$created_at}')";
        $result = $db->exec($sql);
        $db->close();

        return json_encode($result, JSON_THROW_ON_ERROR);
    }

    public static function index(GetEventsRequest $request)
    {
        if (!$request->isValidatedData()) {
            http_response_code(400);
            return json_encode("Bad Request", JSON_THROW_ON_ERROR);
        }

        $filter = $request->getBody()['filter'];
        $column = $request->getBody()['count'];
        if ($column === 'status') {
            $column = 'auth';
        }

        $name_event = $filter['name_event'];

        ['start' => $startPeriod, 'end' => $endPeriod] = $filter['period'];
        $prepareStart = new Carbon($startPeriod);
        $prepareEnd = new Carbon($endPeriod);
        $start = $prepareStart->toDateTimeString();
        $end = $prepareEnd->toDateTimeString();

        $newConnection = new Database();
        $tableName = $newConnection->getTableName();
        $db = $newConnection->getConnection();

        $sql = "SELECT {$column}, COUNT(*) as count_{$column}
                FROM {$tableName} 
                WHERE (event_name = :name_event) AND (created_at BETWEEN :start AND :end)
                GROUP BY {$column}";

        $stmt =$db->prepare($sql);
        $stmt->bindParam(':name_event',$name_event);
        $stmt->bindParam(':start',$start);
        $stmt->bindParam(':end',$end);
        $rowData = $stmt->execute();

        $result = [];
        while ($row = $rowData->fetchArray(SQLITE3_ASSOC)) {
            $result[] = $row;
        }

        return json_encode($result, JSON_THROW_ON_ERROR);
    }

}
