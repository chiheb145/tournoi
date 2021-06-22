<?php

namespace App\Http\Controllers\Api;

use App\Tournois;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiTournoiController extends Controller
{
    public function index()
    {
        $tournois = Tournois::all();

        return response(['tournois' => $tournois]);
    }
}
