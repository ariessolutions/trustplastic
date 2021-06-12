<?php

namespace App\Models;

class Currency
{
    public function format($value)
    {
        return env('CURRENCY').' ' . number_format($value, 2, '.', ',');
    }
}
