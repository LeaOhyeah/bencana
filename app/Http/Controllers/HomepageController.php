<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Summary of HomepageController
 */
class HomepageController extends Controller
{
    /**
     * Summary of index view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('homepage.home');
    }

    /**
     * Summary of testing view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
        return view('udin');
    }

    /**
     * Summary of testing leaflet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function test()
    {

        return view('homepage.test');
    }

    /**
     * Summary of testing geojson view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function geojson()
    {
        return view('homepage.geojson');
    }

    /**
     * Summary of testing getData geojson view 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getData()
    {
        return view('homepage.get_data');
    }
}