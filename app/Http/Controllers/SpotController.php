<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\SpotRepository;

class SpotController extends Controller
{
    public function __construct(SpotRepository $spots)
    {
        $this->spots = $spots;
    }

    //
    public function index()
    {
        return view('spots.index', [
            'spots' => $this->spots->all()
        ]);
    }
}
