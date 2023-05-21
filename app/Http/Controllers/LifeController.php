<?php

namespace App\Http\Controllers;

use App\Models\Life;

use Illuminate\Http\Request;

class LifeController extends Controller
{
    public function index()
    {

        $life = new Life();
        $life->generateRandomGrid();
        $life->createGrid();


        return view('home')->with(compact('life'));
    }
}
