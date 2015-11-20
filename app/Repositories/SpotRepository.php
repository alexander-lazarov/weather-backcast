<?php

namespace App\Repositories;

use App\Spot;

class SpotRepository
{
    public function all()
    {
        return Spot::orderBy('name', 'asc')->get();
    }

    public function getOrCreateByName($name)
    {
        $spot = Spot::where('name', $name)->first();
        if (!$spot) {
            $spot = new Spot;
            $spot->name = $name;
            $spot->save();
        }

        return $spot;
    }
}
