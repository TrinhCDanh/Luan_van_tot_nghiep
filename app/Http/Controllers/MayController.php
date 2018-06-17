<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phongmay;
use App\Models\May;

class MayController extends Controller
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
        $may = new May;
        $may->sothutumay = $request->sothutumay;
        $may->tinhtrang = 0;
        $may->phongmay_id = $request->phongmay_id;
        $may->slug = $request->slug;
        $may->save();

        $slMayCapnhat = May::where('phongmay_id', $may->phongmay_id)->count();
        $phongmay = Phongmay::find($may->phongmay_id);
        $phongmay->soluongmay = $slMayCapnhat;
        $phongmay->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return May::where('slug', $id)->first();
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
        $may = May::where('slug', $id)->first();
        May::destroy($may->id);

        $slMayConLai = May::where('phongmay_id', $may->phongmay_id)->count();
        $phongmay = Phongmay::find($may->phongmay_id);
        $phongmay->soluongmay = $slMayConLai;
        $phongmay->save();
        return $may;
    }


}
