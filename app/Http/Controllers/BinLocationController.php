<?php

namespace App\Http\Controllers;

use App\Models\bin_location;
use Illuminate\Http\Request;

class BinLocationController extends Controller
{
    public function getLocationBinLocationSuggetions($lid)
    {
        foreach ((new bin_location)->getLocationBins($lid) as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => $item->bin_location_name,
            ];
        }

        return response()->json($data, 200);
    }
}
