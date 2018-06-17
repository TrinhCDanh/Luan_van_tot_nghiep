<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

        <!-- Styles -->
        <style>
            html, body {
                /*background-color: #0e5aa8;*/
                
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                color: #ffffff;
                font-family: 'Muli', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;

            }
            
            /* Gradient background color animation */
            body {
                /* width: 100wh;
                height: 90vh; */
                color: #fff;
                background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
                background-size: 400% 400%;
                -webkit-animation: Gradient 15s ease infinite;
                -moz-animation: Gradient 15s ease infinite;
                animation: Gradient 15s ease infinite;
            }

            @-webkit-keyframes Gradient {
                0% {
                    background-position: 0% 50%
                }
                50% {
                    background-position: 100% 50%
                }
                100% {
                    background-position: 0% 50%
                }
            }

            @-moz-keyframes Gradient {
                0% {
                    background-position: 0% 50%
                }
                50% {
                    background-position: 100% 50%
                }
                100% {
                    background-position: 0% 50%
                }
            }

            @keyframes Gradient {
                0% {
                    background-position: 0% 50%
                }
                50% {
                    background-position: 100% 50%
                }
                100% {
                    background-position: 0% 50%
                }
            }

            

            /* End gradient background color animation */

            .full-height {
                height: 100vh;
            }


            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
                /* background-image: url('http://hdqwalls.com/download/blur-blue-gradient-cool-background-sp-1920x1080.jpg'); */
                /*background-color: blue;*/
                animation: displayPage 0.25s;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                background-color: rgba(0,0,0,0.5);
                padding: 30px;
                animation: displayPage 0.75s;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }

            .web-title {
                font-size: 40px;
            }

            .who {
                /* border: 1px solid white;
                padding: 6px 10px;
                color: #ffffff;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase; */
                background-color: #ff6666;
                border-radius: 20px;
                font-weight: bold;
            }
            .who:hover {
                background-color: #304FFE;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .links {
                margin-top: 30px;
            }

            @keyframes displayPage {
                from { opacity: 0 }
                to { opacity: 1 }
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <!-- @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif -->

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
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    </body>
</html>
