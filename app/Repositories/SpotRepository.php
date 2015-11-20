<?php

namespace App\Repositories;

use App\Spot;

class SpotRepository
{
    public function all()
    {
        return Spot::orderBy('name', 'asc')->get();
    }
}
