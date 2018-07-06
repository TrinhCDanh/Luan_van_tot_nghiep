<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monhoc;
use App\Models\Lichtruc;
use App\Models\Lichday;

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
        $monhocExists = Monhoc::where('tenmonhoc', $request->tenmonhoc)->orWhere('mamonhoc', $request->mamonhoc)->count();
        if($monhocExists != 0)
            return response()->json(['error' => 'Mã môn học hoặc tên môn học đã tồn tại'], 200);
        else {
            $monhoc = new Monhoc;
            $monhoc->mamonhoc = $request->mamonhoc;
            $monhoc->tenmonhoc = $request->tenmonhoc;
            $monhoc->ngaybatdau = $request->ngaybatdau;
            $monhoc->ngayketthuc = $request->ngayketthuc;
            $monhoc->save();
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
        $tenmonhocExists = $mamonhocExists = $monhocExists = 0;
        if($monhoc->mamonhoc == $request->mamonhoc && $monhoc->tenmonhoc != $request->tenmonhoc)
            $tenmonhocExists = Monhoc::where('tenmonhoc', $request->tenmonhoc)->count(); 
        if($monhoc->tenmonhoc == $request->tenmonhoc && $monhoc->mamonhoc != $request->mamonhoc)
            $mamonhocExists = Monhoc::where('mamonhoc', $request->mamonhoc)->count();
        if($monhoc->mamonhoc != $request->mamonhoc && $monhoc->tenmonhoc != $request->tenmonhoc)
            $monhocExists = Monhoc::where('tenmonhoc', $request->tenmonhoc)->orWhere('mamonhoc', $request->mamonhoc)->count();
            
        
        if($tenmonhocExists != 0)
            return response()->json(['error' => 'Tên môn học đã tồn tại'], 200);
        else if($mamonhocExists != 0)
            return response()->json(['error' => 'Mã môn học đã tồn tại'], 200);
        else if($monhocExists != 0)
            return response()->json(['error' => 'Mã môn học hoặc tên môn học đã tồn tại'], 200);
        else {
            $monhoc->mamonhoc = $request->mamonhoc;
            $monhoc->tenmonhoc = $request->tenmonhoc;
            $monhoc->ngaybatdau = $request->ngaybatdau;
            $monhoc->ngayketthuc = $request->ngayketthuc;
            $monhoc->save();
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
        $monhocLichday = Lichday::where('monhoc_id', $id)->count();
        if($monhocLichday != 0)
            return response()->json(['error' => 'Không xóa được môn học này'], 200);
        else {
            Monhoc::destroy($id); 
            return response()->json(['success' => 'Xóa thành công'], 200);
        }    
    }
}
