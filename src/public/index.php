<?php

namespace App\Public\Index;

use App\Application\Application;
use App\Application\Requests\EventRequest;
use App\Application\Requests\Request;
use App\Application\Requests\GetEventsRequest;
use App\Controllers\EventController;

$autoloadPath1 = __DIR__ . '/../../autoload.php';
$autoloadPath2 = __DIR__ . '/../../vendor/autoload.php';

if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

$app = new Application();

$app->post('/event', function () {
    $request = new EventRequest();
    return EventController::create($request);
});

$app->post('/get-events', function () {
    $request = new GetEventsRequest();
    return EventController::index($request);
});

$app->run();
