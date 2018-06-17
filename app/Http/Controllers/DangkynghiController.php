<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dangkynghi;
use DB;

class DangkynghiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getNgayNghi($hocky_id) {
        return DB::select('SELECT * FROM dangky_nghi 
                            JOIN chitiet_lichday ON dangky_nghi.chitiet_lichday_id = chitiet_lichday.id 
                            WHERE chitiet_lichday.hocky_id = ?', [$hocky_id] );
    }

    public function getNgayNghiGV($hocky_id, $giangvien_current_id) {
        return DB::select('SELECT * FROM dangky_nghi 
                            JOIN chitiet_lichday ON dangky_nghi.chitiet_lichday_id = chitiet_lichday.id 
                            WHERE chitiet_lichday.hocky_id = ? AND chitiet_lichday.giangvien_id = ?', [$hocky_id, $giangvien_current_id] );
    }
}
