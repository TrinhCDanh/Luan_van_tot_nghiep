<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dangkybu;
use DB;

class DangkybuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $dangkybu = new Dangkybu;
        $dangkybu->dangky_nghi_id = $request->dangky_nghi_id;
        $dangkybu->tentuan = $request->tentuan;
        $dangkybu->thu_id = $request->thu_id;
        $dangkybu->ca_id = $request->ca_id;
        $dangkybu->phongmay_id = $request->phongmay_id;
        $dangkybu->save();
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

    public function getNgayBu($hocky_id) {
        $data = DB::select('SELECT 
                dangky_daybu.id as dangky_daybu_id, dangky_nghi.id as dangky_nghi_id,
                dangky_daybu.tentuan,
                dangky_daybu.thu_id, 
                dangky_daybu.ca_id, 
                dangky_daybu.phongmay_id, 
                chitiet_lichday.hocky_id,
                dangky_nghi.giangvien_id, giangvien.username as tengiangvien,
                chitiet_lichday.monhoc_id, monhoc.tenmonhoc,
                chitiet_lichday.nhomlop_id, nhomlop.nhomlop
            FROM ((((dangky_daybu JOIN dangky_nghi ON dangky_daybu.dangky_nghi_id = dangky_nghi.id) 
            JOIN chitiet_lichday ON dangky_nghi.chitiet_lichday_id = chitiet_lichday.id)
            JOIN giangvien ON giangvien.id = chitiet_lichday.giangvien_id)
            JOIN nhomlop ON nhomlop.id = chitiet_lichday.nhomlop_id)
            JOIN monhoc ON monhoc.id = chitiet_lichday.monhoc_id
            WHERE chitiet_lichday.hocky_id = ?', [$hocky_id]
        );
        return $data;
    }

    public function getNgayBuGV($hocky_id, $giangvien_current_id) {
        $data = DB::select('SELECT 
                dangky_daybu.id as dangky_daybu_id, dangky_nghi.id as dangky_nghi_id,
                dangky_daybu.tentuan,
                dangky_daybu.thu_id, thu.tenthu,
                dangky_daybu.ca_id, ca.tenca,
                dangky_daybu.phongmay_id, phongmay.tenphongmay as tenphongmay, 
                chitiet_lichday.hocky_id,
                dangky_nghi.giangvien_id, giangvien.username as tengiangvien,
                chitiet_lichday.monhoc_id, monhoc.tenmonhoc,
                chitiet_lichday.nhomlop_id, nhomlop.nhomlop
            FROM (((((((dangky_daybu JOIN dangky_nghi ON dangky_daybu.dangky_nghi_id = dangky_nghi.id) 
            JOIN chitiet_lichday ON dangky_nghi.chitiet_lichday_id = chitiet_lichday.id)
            JOIN giangvien ON giangvien.id = chitiet_lichday.giangvien_id)
            JOIN nhomlop ON nhomlop.id = chitiet_lichday.nhomlop_id)
            JOIN monhoc ON monhoc.id = chitiet_lichday.monhoc_id)
            JOIN thu ON thu.id = chitiet_lichday.thu_id)
            JOIN ca ON ca.id = chitiet_lichday.ca_id)
            JOIN phongmay ON dangky_daybu.phongmay_id = phongmay.id
            WHERE chitiet_lichday.hocky_id = ? AND chitiet_lichday.giangvien_id = ?', [$hocky_id, $giangvien_current_id]
        );
        return $data;
    }
}
