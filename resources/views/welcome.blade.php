@extends('layouts.master')
@section('content')
    <div class="content">
        <div class="m-b-md">
            <image src="http://www.stu.edu.vn/images/logo.png" style="width: 50%"/>
            <h1 class="web-title">Trung tâm máy tính v1</h1>
            <p>Bạn là...</p>
        </div>

        <div class="links">
            <!-- <a class="who" href="http://luanvantotnghiep.local/giangvien/home">Giảng viên</a>
            <a class="who" href="http://luanvantotnghiep.local/kythuatvien/home">Kỹ thuật viên</a>
            <a class="who" href="http://luanvantotnghiep.local/admin/home">Admin</a> -->
            <a href="http://luanvantotnghiep.local/giangvien/home" class="waves-effect waves-light btn-small who">Giảng viên</a>
            <a href="http://luanvantotnghiep.local/kythuatvien/home" class="waves-effect waves-light btn-small who">Kỹ thuật viên</a>
        </div>

        <!-- <div class="demo-note" style="margin-top: 20px;">
            <p>tài khoản admin: admin@admin.com</p>
            <p>pass: admin123</p>
            <p>tài khoản admin: kythuatvien02@gmail.com</p>
            <p>pass: KTV022</p> 
        </div> -->
    </div>
@endsection

