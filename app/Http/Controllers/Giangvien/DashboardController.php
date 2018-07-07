<?php

namespace App\Http\Controllers\Giangvien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Giangvien;
use App\Models\Lichday;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {   
        $giangvien_current = Auth::guard('giangvien')->id();
        $giangvien = giangvien::find($giangvien_current);
        $giangvien->status = 1;
        $giangvien->save();
        //print_r($this->giangvien_current_id);
        //return view('giangvien.index');
        return view('home-giangvien', compact('giangvien_current'));
        //return view('giangvien.index');
    }
}


