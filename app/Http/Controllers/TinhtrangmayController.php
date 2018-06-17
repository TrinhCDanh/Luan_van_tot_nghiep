<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\May;
use App\Models\Tinhtrangmay;
use App\Models\ChitietBaotri;
use DB;

class TinhtrangmayController extends Controller
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
        $may = May::where('slug', $request->may_slug)->first();

        $tinhtrangmay = new Tinhtrangmay;
        $tinhtrangmay->ngayghinhan = date("Y-m-d H:i:s");
        $tinhtrangmay->mota_kythuatvien = $request->mota_kythuatvien;
        $tinhtrangmay->mota_giangvien = $request->mota_giangvien;
        $tinhtrangmay->may_id = $may['id'];
        $tinhtrangmay->save();

        $ct_baotri = new ChitietBaotri;
        $ct_baotri->tinhtrangmay_id = $tinhtrangmay->id;
        $ct_baotri->kythuatvien_id = $request->kythuatvien_id;
        $ct_baotri->save();

        $may->tinhtrang = $request->tinhtrang;
        $may->save();

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
        return Tinhtrangmay::find($id);
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
        $may = May::where('slug', $request->may_slug)->first();

        $tinhtrangmay = Tinhtrangmay::find($id);
        //$tinhtrangmay->ngayghinhan = date("Y-m-d H:i:s");
        $tinhtrangmay->mota_kythuatvien = $request->mota_kythuatvien;
        $tinhtrangmay->mota_giangvien = $request->mota_giangvien;
        $tinhtrangmay->may_id = $may['id'];
        $tinhtrangmay->save();

        // $ct_baotri = ChitietBaotri::where('tinhtrangmay_id' , $id)->first();
        // $ct_baotri->tinhtrangmay_id = $tinhtrangmay->id;
        // $ct_baotri->kythuatvien_id = $request->kythuatvien_id;
        // $ct_baotri->save();

        $may->tinhtrang = $request->tinhtrang;
        $may->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tinhtrangmay = Tinhtrangmay::find($id);
        $ct_baotri = ChitietBaotri::where('tinhtrangmay_id', $tinhtrangmay->id)->delete();
        $tinhtrangmay->delete();
    }

    public function listTinhtrangmay($may_slug) {
        $data = DB::select('SELECT kythuatvien.name as tenkythuatvien, giangvien.username as tengiangvien,
                tinhtrangmay.ngayghinhan, tinhtrangmay.mota_kythuatvien, tinhtrangmay.mota_giangvien,
                tinhtrangmay.id, kythuatvien.id as kythuatvien_id
                FROM ((((may JOIN tinhtrangmay on may.id = tinhtrangmay.may_id)
                LEFT JOIN chitiet_ghinhan on tinhtrangmay.id = chitiet_ghinhan.tinhtrangmay_id)
                LEFT JOIN chitiet_baotri on tinhtrangmay.id = chitiet_baotri.tinhtrangmay_id)
                LEFT JOIN kythuatvien on chitiet_baotri.kythuatvien_id = kythuatvien.id)
                LEFT JOIN giangvien on chitiet_ghinhan.giangvien_id = giangvien.id
                WHERE may.slug = ? ORDER BY tinhtrangmay.ngayghinhan DESC', [$may_slug]);
        return $data;
    }

    public function soMayLoi() {
        // $data = DB::table('may')
        //         ->join('phongmay', 'may.phongmay_id', '=', 'phongmay.id')
        //         ->where('tinhtrang', 1)->where('phongmay_id', $phongmay_id)
        //         ->get()->count('may.tinhtrang');
        $data = DB::select('SELECT * from phongmay LEFT JOIN 
        (SELECT phongmay.id as phongmay_id, COUNT(tinhtrang) as somayloi from phongmay LEFT JOIN may on may.phongmay_id = phongmay.id WHERE tinhtrang = 1 GROUP BY phongmay_id) as A
        on A.phongmay_id = phongmay.id ORDER BY id ASC');
        return $data;
    }
}

// DB::select('SELECT phongmay.tenphongmay, COUNT(may.tinhtrang) as mayloi, phongmay.id as phongmay_id
// FROM may JOIN phongmay on may.phongmay_id = phongmay.id
// WHERE tinhtrang = 1 AND phongmay_id = ? GROUP BY phongmay.tenphongmay', [$phongmay_id]);
