<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lichtruc;
use DB;
use Auth;

class LichtrucController extends Controller
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
        $lichtruc = new Lichtruc;
        $lichtruc->hocky_id = $request->hocky_id;
        $lichtruc->thu_id = $request->thu_id;
        $lichtruc->ca_id = $request->ca_id;
        $lichtruc->kythuatvien_id = $request->kythuatvien_id;
        $lichtruc->ghichu = $request->ghichu;
        $lichtruc->save();
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
        $data = DB::select('
                    SELECT chitiet_truc.id, chitiet_truc.ca_id, chitiet_truc.thu_id, kythuatvien.id as kythuatvien_id, kythuatvien.name, chitiet_truc.hocky_id, thu.tenthu, ca.tenca, hocky.tenhocky, hocky.namhoc
                    FROM (((chitiet_truc JOIN hocky ON chitiet_truc.hocky_id = hocky.id)
                    JOIN thu ON chitiet_truc.thu_id = thu.id) JOIN ca ON chitiet_truc.ca_id = ca.id)
                    JOIN kythuatvien ON chitiet_truc.kythuatvien_id = kythuatvien.id
                    WHERE chitiet_truc.id = ?', [$id]
                );
        return $data;
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
        $lichtruc = Lichtruc::find($id);
        $lichtruc->hocky_id = $request->hocky_id;
        $lichtruc->thu_id = $request->thu_id;
        $lichtruc->ca_id = $request->ca_id;
        $lichtruc->kythuatvien_id = $request->kythuatvien_id;
        $lichtruc->ghichu = $request->ghichu;
        $lichtruc->save();
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
        $lichtruc = Lichtruc::find($id);
        $lichtruc->delete();
    }

    public function lichtrucHocky($hocky_id) {
        $data = DB::select('
                    SELECT chitiet_truc.id, chitiet_truc.ca_id, chitiet_truc.thu_id, kythuatvien.name, chitiet_truc.hocky_id, kythuatvien.id as kythuatvien_id
                    FROM (((chitiet_truc JOIN hocky ON chitiet_truc.hocky_id = hocky.id)
                    JOIN thu ON chitiet_truc.thu_id = thu.id) JOIN ca ON chitiet_truc.ca_id = ca.id)
                    JOIN kythuatvien ON chitiet_truc.kythuatvien_id = kythuatvien.id
                    WHERE hocky_id = ?', [$hocky_id]
                );
        return $data;
    }

    public function lichtrucHockyKTV($hocky_id) {
        $kythuatvien_current = Auth::guard('kythuatvien')->id();
        return $kythuatvien_current;
        // $data = DB::select('
        //             SELECT chitiet_truc.id, chitiet_truc.ca_id, chitiet_truc.thu_id, kythuatvien.name, chitiet_truc.hocky_id
        //             FROM (((chitiet_truc JOIN hocky ON chitiet_truc.hocky_id = hocky.id)
        //             JOIN thu ON chitiet_truc.thu_id = thu.id) JOIN ca ON chitiet_truc.ca_id = ca.id)
        //             JOIN kythuatvien ON chitiet_truc.kythuatvien_id = kythuatvien.id
        //             WHERE hocky_id = ? and kythuatvien.id = ?' , [$hocky_id, $kythuatvien_current]
        //         );
        // return $data;
    }
}
