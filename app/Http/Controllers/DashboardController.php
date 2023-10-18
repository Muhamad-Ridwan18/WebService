<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    
    public function index() {
        return "Selamat datang di dashboard!";
    }

    public function getData()
    {
        return "Selamat datang di laporan dashboard!";
    }

}
