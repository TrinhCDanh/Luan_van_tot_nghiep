<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dangkynghi;
use App\Models\Dangkybu;
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
        $dangkynghi = new Dangkynghi;
        $dangkynghi->tentuan = $request->tentuan;
        $dangkynghi->giangvien_id = $request->giangvien_id;
        $dangkynghi->chitiet_lichday_id = $request->chitiet_lichday_id;
        $dangkynghi->save();
        return $dangkynghi->id;
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
        $dangkynghi = Dangkynghi::find($id);
        $dangkynghi->delete();
        Dangkybu::where('dangky_nghi_id', $id)->delete();
        return 'success';
    }

    public function getNgayNghi($hocky_id) {
        return DB::select('SELECT * FROM dangky_nghi 
                            JOIN chitiet_lichday ON dangky_nghi.chitiet_lichday_id = chitiet_lichday.id 
                            WHERE chitiet_lichday.hocky_id = ?', [$hocky_id] );
    }

    public function getNgayNghiGV($hocky_id, $giangvien_current_id) {
        // return DB::select('SELECT *, dangky_nghi.id as dangky_nghi_id FROM dangky_nghi 
        //                     JOIN chitiet_lichday ON dangky_nghi.chitiet_lichday_id = chitiet_lichday.id 
        //                     WHERE chitiet_lichday.hocky_id = ? AND chitiet_lichday.giangvien_id = ?', [$hocky_id, $giangvien_current_id] );
        return DB::select('SELECT 
                                dangky_nghi.id as dangky_nghi_id,
                                dangky_nghi.tentuan,
                                phongmay.id as phongmay_id, phongmay.tenphongmay, 
                                giangvien.id as giangvien_id, giangvien.username, 
                                thu.id as thu_id, thu.tenthu, 
                                ca.id as ca_id, ca.tenca, 
                                nhomlop.id as nhomlop_id, nhomlop.nhomlop, 
                                monhoc.id as monhoc_id, monhoc.tenmonhoc, 
                                hocky.id as hocky_id, hocky.tenhocky
                            FROM (((((((dangky_nghi JOIN chitiet_lichday ON dangky_nghi.chitiet_lichday_id = chitiet_lichday.id)
                            JOIN monhoc ON chitiet_lichday.monhoc_id = monhoc.id)
                            JOIN giangvien ON giangvien.id = chitiet_lichday.giangvien_id)
                            JOIN thu ON thu.id = chitiet_lichday.thu_id)
                            JOIN ca ON ca.id = chitiet_lichday.ca_id)
                            JOIN hocky on hocky.id = chitiet_lichday.hocky_id)
                            JOIN phongmay ON chitiet_lichday.phongmay_id = phongmay.id)
                            JOIN nhomlop ON nhomlop.id = chitiet_lichday.nhomlop_id
                            WHERE chitiet_lichday.hocky_id = ? AND chitiet_lichday.giangvien_id = ?', [$hocky_id, $giangvien_current_id] );
    }
}
