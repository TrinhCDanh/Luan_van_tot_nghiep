<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Giangvien;
use Hash;
use Validator;

class GiangvienController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return giangvien::orderBy('id','DESC')->get();
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
        $giangvien = new giangvien;
        $giangvien->magiangvien = $request->magiangvien;
        $giangvien->name = $request->name;
        $giangvien->email = $request->email;
        $giangvien->password = Hash::make($request->password);
        $giangvien->status = 0;
        $giangvien->remember_token = $request->_token; //csrf_token();
        $giangvien->save();
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
        return giangvien::find($id);
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
        $giangvien = giangvien::find($id);
        $giangvien->magiangvien = $request->magiangvien;
        $giangvien->name = $request->name;
        $giangvien->email = $request->email;
        if($request->password != '')
            $giangvien->password = Hash::make($request->password);
        //$giangvien->status = 0;
        $giangvien->remember_token = $request->_token; //csrf_token();
        $giangvien->save();
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
        $giangvien = giangvien::find($id);
        $giangvien->delete();
    }

    public function updategiangvien(Request $request, $id) {
        $giangvien = giangvien::find($id);

        //$old_pass = Hash::make($request->oldpassword);
        $giangvien->magiangvien = $request->magiangvien;
        $giangvien->name = $request->name;

        if($request->oldpassword == '') {
            $giangvien->save();
        }
        else if (Hash::check($request->oldpassword, $giangvien->password)) {
            if($request->confirmpassword != '')
                $giangvien->password = Hash::make($request->confirmpassword);
            $giangvien->save();
            return response()->json(['success' => 'Cập nhật thành công'], 200);
        } else {
            return response()->json(['fail' => 'Nhập sai mật khẩu cũ'], 200);
        }


         

        
        // if($giangvien->password != $old_pass)
        //     return response()->json(['fail' => 'Nhập sai mật khẩu cũ', 'qslpass'=> $giangvien->password, 'oldpass'=>$old_pass, 'sss'=>$request->oldpassword, 'name'=>$giangvien->name], 200);
        // else {
        //     $giangvien->magiangvien = $request->magiangvien;
        //     $giangvien->name = $request->name;
        //     if($request->confirmpassword != '')
        //         $giangvien->password = Hash::make($request->confirmpassword);
        //     //$giangvien->status = 0;
        //     //$giangvien->remember_token = $request->_token; //csrf_token();
        //     $giangvien->save();
        //     // return response()->json(['success' => 'You have successfully uploaded an image'], 200);
        //     return 'ok';
        // }  
        
    }

    public function uploadAvatarKTV(Request $request, $id) {
        $giangvien = giangvien::find($id);

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

            $giangvien->image = $name;
            $giangvien->save();
            return $name;
        }
    }
}
