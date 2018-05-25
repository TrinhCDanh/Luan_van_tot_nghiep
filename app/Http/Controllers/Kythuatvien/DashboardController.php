<?php

namespace App\Http\Controllers\Kythuatvien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('kythuatvien.index');
    }
}
