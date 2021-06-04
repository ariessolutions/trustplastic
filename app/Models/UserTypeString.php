<?php

namespace App\Models;

class UserTypeString
{
    public function getType($val)
    {
        $resp = '';

        switch ($val) {
            case 1:
                $resp = 'Administrator';
                break;
            case 2:
                $resp = 'Manager';
                break;
            case 3:
                $resp = 'Super Administrator';
                break;
            default:
                $resp = 'Non-identified';
                break;
        }

        return $resp;
    }
}
