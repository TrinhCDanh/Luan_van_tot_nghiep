<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kythuatvien;
use App\Models\Lichtruc;
use App\Models\ChitietBaotri;
use Hash;
use Validator;

class KythuatvienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Kythuatvien::orderBy('id','DESC')->get();
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
        $kythuatvienExists = Kythuatvien::where('email', $request->email)->orWhere('makythuatvien', $request->makythuatvien)->count();
        if($kythuatvienExists != 0)
            return response()->json(['error' => 'Mã kỹ thuật viên hoặc email đã tồn tại'], 200);
        else {
            $kythuatvien = new Kythuatvien;
            $kythuatvien->makythuatvien = $request->makythuatvien;
            $kythuatvien->name = $request->name;
            $kythuatvien->email = $request->email;
            $kythuatvien->password = Hash::make($request->password);
            $kythuatvien->status = 0;
            $kythuatvien->remember_token = $request->_token; //csrf_token();
            $kythuatvien->save();
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
        return Kythuatvien::find($id);
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
        $kythuatvien = Kythuatvien::find($id);
        $maKtvExists = $emailKtvExists = $kythuatvienExists = 0;
        
        if($kythuatvien->makythuatvien == $request->makythuatvien && $kythuatvien->email != $request->email)
            $emailKtvExists = Kythuatvien::where('email', $request->email)->count(); 
        if($kythuatvien->makythuatvien != $request->makythuatvien && $kythuatvien->email == $request->email)
            $maKtvExists = Kythuatvien::where('makythuatvien', $request->makythuatvien)->count();
        if($kythuatvien->makythuatvien != $request->makythuatvien && $kythuatvien->email != $request->email)
            $kythuatvienExists = Kythuatvien::where('email', $request->email)->orWhere('makythuatvien', $request->makythuatvien)->count();

        if($emailKtvExists != 0)
            return response()->json(['error' => 'Email này đã tồn tại'], 200);
        else if($maKtvExists != 0)
            return response()->json(['error' => 'Mã kỹ thuật viên này đã tồn tại'], 200);
        else if($kythuatvienExists != 0)
            return response()->json(['error' => 'Mã kỹ thuật viên hoặc email đã tồn tại'], 200);
        else {
            $kythuatvien->makythuatvien = $request->makythuatvien;
            $kythuatvien->name = $request->name;
            $kythuatvien->email = $request->email;
            if($request->password != '')
                $kythuatvien->password = Hash::make($request->password);
            $kythuatvien->remember_token = $request->_token; //csrf_token();
            $kythuatvien->save();
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
        $ktvLichtruc = Lichtruc::where('kythuatvien_id', $id)->count();
        $ktvBaotri = ChitietBaotri::where('kythuatvien_id', $id)->count();

        if($ktvLichtruc != 0 || $ktvBaotri != 0)
            return response()->json(['error' => 'Không xóa được kỹ thuật viên này'], 200);
        else {
            Kythuatvien::destroy($id); 
            return response()->json(['success' => 'Xóa thành công'], 200);
        }  
    }

    public function updateKythuatvien(Request $request, $id) {
        $kythuatvien = Kythuatvien::find($id);

        //$old_pass = Hash::make($request->oldpassword);
        $kythuatvien->makythuatvien = $request->makythuatvien;
        $kythuatvien->name = $request->name;

        if($request->oldpassword == '') {
            $kythuatvien->save();
        }
        else if (Hash::check($request->oldpassword, $kythuatvien->password)) {
            if($request->confirmpassword != '')
                $kythuatvien->password = Hash::make($request->confirmpassword);
            $kythuatvien->save();
            return response()->json(['success' => 'Cập nhật thành công'], 200);
        } else {
            return response()->json(['fail' => 'Nhập sai mật khẩu cũ'], 200);
        }


         

        
        // if($kythuatvien->password != $old_pass)
        //     return response()->json(['fail' => 'Nhập sai mật khẩu cũ', 'qslpass'=> $kythuatvien->password, 'oldpass'=>$old_pass, 'sss'=>$request->oldpassword, 'name'=>$kythuatvien->name], 200);
        // else {
        //     $kythuatvien->makythuatvien = $request->makythuatvien;
        //     $kythuatvien->name = $request->name;
        //     if($request->confirmpassword != '')
        //         $kythuatvien->password = Hash::make($request->confirmpassword);
        //     //$kythuatvien->status = 0;
        //     //$kythuatvien->remember_token = $request->_token; //csrf_token();
        //     $kythuatvien->save();
        //     // return response()->json(['success' => 'You have successfully uploaded an image'], 200);
        //     return 'ok';
        // }  
        
    }

    public function uploadAvatarKTV(Request $request, $id) {
        $kythuatvien = Kythuatvien::find($id);

        $file = $request->image;
        
        $validator = Validator::make($request->all(),
        [
            'image' => 'mimes:jpeg,png,jpg|max:1000'
        ],
        [
            "image.image64" => "Đây không phải là file hình",
            "image.max" => 'Dung lượng ảnh lớn hơn 1MB'
        ]);

        if ($validator->fails()) {
            return response()->json(['fail'=>$validator->errors()]);
        } else {
            $name =  $file->getClientOriginalName();
            $file->move(public_path('images'), $name);

            $kythuatvien->image = $name;
            $kythuatvien->save();
            return $name;
        }
    }
 }
