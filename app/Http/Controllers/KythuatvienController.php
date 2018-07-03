<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kythuatvien;
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
        $kythuatvien = new Kythuatvien;
        $kythuatvien->makythuatvien = $request->makythuatvien;
        $kythuatvien->name = $request->name;
        $kythuatvien->email = $request->email;
        $kythuatvien->password = Hash::make($request->password);
        $kythuatvien->status = 0;
        $kythuatvien->remember_token = $request->_token; //csrf_token();

        $kythuatvien->save();
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
        $kythuatvien->makythuatvien = $request->makythuatvien;
        $kythuatvien->name = $request->name;
        $kythuatvien->email = $request->email;
        if($request->password != '')
            $kythuatvien->password = Hash::make($request->password);
        //$kythuatvien->status = 0;
        $kythuatvien->remember_token = $request->_token; //csrf_token();
        $kythuatvien->save();
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
        $kythuatvien = Kythuatvien::find($id);
        $kythuatvien->delete();
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
