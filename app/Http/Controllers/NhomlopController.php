<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nhomlop;
use App\Models\Lichday;

class NhomlopController extends Controller
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
        $nhomlopExists = Nhomlop::where('nhomlop', $request->nhomlop)->where('hocky_id', $request->hocky_id)->count();
        if($nhomlopExists != 0)
            return response()->json(['error' => 'Thông tin nhóm lớp đã tồn tại'], 200);
        else {
            $nhomlop = new Nhomlop;
            $nhomlop->nhomlop = $request->nhomlop;
            $nhomlop->siso = $request->siso;
            $nhomlop->hocky_id = $request->hocky_id;
            $nhomlop->save();
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
        return Nhomlop::find($id);
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
        $nhomlop = Nhomlop::find($id);
        $nhomlopExists = 0;

        if(trim($nhomlop->nhomlop," ") == $request->nhomlop  && $nhomlop->hocky_id == $request->hocky_id)
            $nhomlopExists = 0;
        if(trim($nhomlop->nhomlop," ") != $request->nhomlop || $nhomlop->hocky_id != $request->hocky_id)
            $nhomlopExists = Nhomlop::where('nhomlop', $request->nhomlop)->where('hocky_id', $request->hocky_id)->count();

        if($nhomlopExists != 0)
            return response()->json(['error' => 'Thông tin nhóm lớp đã tồn tại'], 200);
        else {
            $nhomlop->nhomlop = $request->nhomlop;
            $nhomlop->siso = $request->siso;
            $nhomlop->hocky_id = $request->hocky_id;
            $nhomlop->save();
            return response()->json(['success' => 'Thêm thành công'], 200);
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
        $nhomlopLichday = Lichday::where('nhomlop_id', $id)->count();
        if($nhomlopLichday != 0)
            return response()->json(['error' => 'Không xóa được nhóm lớp này'], 200);
        else {
            Nhomlop::destroy($id); 
            return response()->json(['success' => 'Xóa thành công'], 200);
        } 
    }

    public function nhomlopHocky($hocky_id) {
        return Nhomlop::where('hocky_id', $hocky_id)->get();
    }
}
