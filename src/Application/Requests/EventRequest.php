<?php

namespace App\Application\Requests;


Class EventRequest extends Request
{
    public static function isValidatedData()
    {
        $data = (new Request)->getBody();

        if (!array_key_exists('event', $data)) {
            return false;
        }

        if (!array_key_exists('name', $data['event'])) {
            return false;
        }

        if (!array_key_exists('auth', $data)) {
            return false;
        }
        return true;
    }
}
