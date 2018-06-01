<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monhoc;

class MonhocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Monhoc::orderBy('id','DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
//        $monhoc = new Monhoc;
//        $monhoc->id = $request->id;
//        $monhoc->tenmonhoc = $request->tenmonhoc;
//        $monhoc->ngaybatdau = $request->ngaybatdau;
//        $monhoc->ngayketthuc = $request->ngayketthuc;
//        $monhoc->save();
//        //return 'ok';
//        return "This is create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $monhoc = new Monhoc;
        $monhoc->mamonhoc = $request->mamonhoc;
        $monhoc->tenmonhoc = $request->tenmonhoc;
        $monhoc->ngaybatdau = $request->ngaybatdau;
        $monhoc->ngayketthuc = $request->ngayketthuc;
        $monhoc->save();
        // return 'ok';
        return "This is store";
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
        return Monhoc::find($id);
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
        $monhoc = Monhoc::find($id);
        $monhoc->mamonhoc = $request->mamonhoc;
        $monhoc->tenmonhoc = $request->tenmonhoc;
        $monhoc->ngaybatdau = $request->ngaybatdau;
        $monhoc->ngayketthuc = $request->ngayketthuc;
        $monhoc->save();
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
        $monhoc = Monhoc::find($id);
        $monhoc->delete();
    }
}
