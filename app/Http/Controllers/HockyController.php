<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hocky;

class HockyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Hocky::orderBy('id','DESC')->get();
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
        // print_r($request->all());
        //$hocky = new Hocky;
        // $hocky->tenhocky = $request->tenhocky;
        // $hocky->namhoc = $request->namhoc;
        // $hocky->ngaybatdau = $request->ngaybatdau;
        // $hocky->ngayketthuc = $request->ngayketthuc;
        // $hocky->save();
        // return 'ok';
        return Hocky::create($request->all());
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
        return Hocky::find($id);
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
        $hocky = Hocky::find($id);
        $hocky->tenhocky = $request->tenhocky;
        $hocky->namhoc = $request->namhoc;
        $hocky->ngaybatdau = $request->ngaybatdau;
        $hocky->ngayketthuc = $request->ngayketthuc;
        $hocky->save();
        return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Hocky::find($id);
        $post->delete();
    }
}
