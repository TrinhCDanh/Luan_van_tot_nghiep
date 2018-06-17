<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phongmay;
use App\Models\May;

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

        return 'ok';
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
        $phongmay = Phongmay::find($id);
        $phongmay->delete();
    }

    public function listMaybyPhongMay($id) {
        return May::where('phongmay_id', $id)->get();
    }
}
