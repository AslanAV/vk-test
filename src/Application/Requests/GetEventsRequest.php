<?php

namespace App\Application\Requests;


Class GetEventsRequest extends Request
{
    public static function isValidatedData()
    {
        $data = (new Request)->getBody();

        if (!array_key_exists('filter', $data)) {
            return false;
        }

        if (!array_key_exists('name_event', $data['filter'])) {
            return false;
        }

        if (!array_key_exists('period', $data['filter'])) {
            return false;
        }

        if (!array_key_exists('start', $data['period'])) {
            return false;
        }

        if (!array_key_exists('end', $data['period'])) {
            return false;
        }

        if (!array_key_exists('count', $data)) {
            return false;
        }
        return true;
    }
}
