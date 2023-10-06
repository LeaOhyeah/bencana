<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        return view('homepage.home');
    }

    public function test()
    {

        return view('homepage.test');
    }

    public function geojson()
    {
        return view('homepage.geojson');
    }

    public function getData()
    {
        return view('homepage.get_data');
    }
}