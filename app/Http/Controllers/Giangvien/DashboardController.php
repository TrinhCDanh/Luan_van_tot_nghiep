<?php

namespace App\Http\Controllers\Giangvien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('giangvien.index');
    }
}


