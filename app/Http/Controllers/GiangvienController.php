<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Giangvien;
use App\Models\Lichday;
use App\Models\ChitietGhinhan;
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
        $giangvienExists = Giangvien::where('email', $request->email)->orWhere('magiangvien', $request->magiangvien)->count();
        if($giangvienExists != 0)
            return response()->json(['error' => 'Mã giảng viên hoặc email đã tồn tại'], 200);
        else {
            $giangvien = new Giangvien;
            $giangvien->magiangvien = $request->magiangvien;
            $giangvien->username = $request->username;
            $giangvien->email = $request->email;
            $giangvien->password = Hash::make($request->password);
            $giangvien->status = 0;
            $giangvien->remember_token = $request->_token; //csrf_token();
            $giangvien->save();
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
        $maGvExists = $emailGvExists = $giangvienExists = 0;
        
        if($giangvien->magiangvien == $request->magiangvien && $giangvien->email != $request->email)
            $emailGvExists = giangvien::where('email', $request->email)->count(); 
        if($giangvien->magiangvien != $request->magiangvien && $giangvien->email == $request->email)
            $maGvExists = giangvien::where('magiangvien', $request->magiangvien)->count();
        if($giangvien->magiangvien != $request->magiangvien && $giangvien->email != $request->email)
            $giangvienExists = giangvien::where('email', $request->email)->orWhere('magiangvien', $request->magiangvien)->count();

        if($emailGvExists != 0)
            return response()->json(['error' => 'Email này đã tồn tại'], 200);
        else if($maGvExists != 0)
            return response()->json(['error' => 'Mã kỹ thuật viên này đã tồn tại'], 200);
        else if($giangvienExists != 0)
            return response()->json(['error' => 'Mã kỹ thuật viên hoặc email đã tồn tại'], 200);
        else {
            $giangvien->magiangvien = $request->magiangvien;
            $giangvien->username = $request->username;
            $giangvien->email = $request->email;
            if($request->password != '')
                $giangvien->password = Hash::make($request->password);
            $giangvien->remember_token = $request->_token;
            $giangvien->save();
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
        $giangvien = giangvien::find($id);
        $giangvien->delete();

        $gvLichday = Lichday::where('giangvien_id', $id)->count();
        $gvGhinhan = ChitietGhinhan::where('giangvien_id', $id)->count();

        if($gvLichday != 0 || $gvGhinhan != 0)
            return response()->json(['error' => 'Không xóa được giảng viên này'], 200);
        else {
            Kythuatvien::destroy($id); 
            return response()->json(['success' => 'Xóa thành công'], 200);
        }  
    }

    public function updateGiangvien(Request $request, $id) {
        $giangvien = giangvien::find($id);

        //$old_pass = Hash::make($request->oldpassword);
        $giangvien->magiangvien = $request->magiangvien;
        $giangvien->username = $request->username;

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

    public function uploadAvatarGV(Request $request, $id) {
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
