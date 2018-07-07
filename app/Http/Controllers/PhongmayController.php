<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phongmay;
use App\Models\May;
use App\Models\Lichtruc;
use App\Models\Lichday;

class PhongmayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Phongmay::all();
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
        // return Phongmay::create($request->all());
        $phongmayExists = Phongmay::where('tenphongmay',$request->tenphongmay)->count();

        if($phongmayExists != 0)
            return response()->json(['error' => 'Phòng máy đã tồn tại'], 200);
        else {
            $phongmay = new Phongmay;
            $phongmay->tenphongmay = $request->tenphongmay;
            $phongmay->soluongmay = $request->soluongmay;
            $phongmay->slug = str_slug($phongmay->tenphongmay);
            $phongmay->save();

            $tenphongmayArr = explode("M", $phongmay->tenphongmay);
            $tenphongmay = $tenphongmayArr[0].$tenphongmayArr[1];

            for($i = 1; $i <= $phongmay->soluongmay; $i++) {
                $may = new May;
                $may->sothutumay = $tenphongmay. "_" .str_pad($i, 2, '0', STR_PAD_LEFT);
                $may->tinhtrang = 0;
                $may->phongmay_id = $phongmay->id;
                $may->slug = str_slug($may->sothutumay);
                $may->save();
            }
            return response()->json(['success' => 'Thêm thành công'], 200);
        }   
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
        return Phongmay::find($id);
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
        $phongmayExists = Phongmay::where('tenphongmay',$request->tenphongmay)->count();

        if($phongmayExists != 0)
            return response()->json(['error' => 'Phòng máy đã tồn tại'], 200);
        else {
            $phongmay = Phongmay::find($id);
            $phongmay->tenphongmay = $request->tenphongmay;
            $phongmay->slug = str_slug($phongmay->tenphongmay);
            $phongmay->save();

            $tenphongmayArr = explode("M", $phongmay->tenphongmay);
            $tenphongmay = $tenphongmayArr[0].$tenphongmayArr[1];

            $mayList = May::where('phongmay_id', $phongmay->id)->get()->toArray();

            foreach($mayList as $mayItem) {
                $may = May::find($mayItem['id']);
                $nameOldArr = explode("_", $may->sothutumay);
                $may->sothutumay = $tenphongmay . "_" . $nameOldArr[1];
                $may->slug = str_slug($may->sothutumay);
                $may->save();
            }
            return response()->json(['success' => 'Cập nhật thành công'], 200);
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $phongmayLichday = Lichday::where('phongmay_id', $id)->count();
        $phongmayMay = May::where('phongmay_id', $id)->count();
        if($phongmayLichday != 0 || $phongmayMay != 0)
            return response()->json(['error' => 'Không xóa được phòng máy này'], 200);
        else {
            Phongmay::destroy($id); 
            return response()->json(['success' => 'Xóa thành công'], 200);
        }    
    }

    public function listMaybyPhongMay($id) {
        $mayList = May::where('phongmay_id', $id)->get();
        $phongmay = Phongmay::where('id', $id)->get();

        return response()->json(['mayList' => $mayList, 'phongmay' => $phongmay], 200);
    }
}
