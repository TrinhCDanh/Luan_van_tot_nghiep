<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hocky;
use DateTime;

class HockyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //hocky trong model
        return Hocky::orderBy('id','DESC')->get();

//            return Hocky::select('tenhocky','namhoc')->get();
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

    public function tuanhoc($hocky_id) {
        $hocky = Hocky::where('id', $hocky_id)->first();
        $ngaybatdau = new DateTime($hocky->ngaybatdau);
        $ngayketthuc = new DateTime($hocky->ngayketthuc);

        // print_r($ngaybatdau);
        // print_r($ngayketthuc);
        
        //$date= "2018/06/16";

        //$myDate = new DateTime($date);

        //$myDate->modify("+7 days"); // +7 ngày 

       // echo $myDate->format("l, d, m, Y"); // Sunday 03rd, 12, 2017

        $interval  = date_diff($ngaybatdau, $ngayketthuc);
        $so_ngay_hoc_ky = ($interval ->days + 1) / 7;

      
        $dto = $ngaybatdau;
        //$tuan_hoc = array();
        $item = '';
        // $ngaydautuan = $dto->format("l, d, m, Y");
        // $dto->modify('+6 days');
        // $ngaycuoituan = $dto->format("l, d, m, Y");
        // echo $ngaydautuan;
        // echo $ngaycuoituan;

        for($i = 1; $i <= $so_ngay_hoc_ky; $i++) {
            $ngaydautuan = $dto->format("Y-m-d");
            $ngaydautuanText = $dto->format("d-m-Y");
            $dto->modify('+6 days');
            $ngaycuoituan = $dto->format("Y-m-d");
            $ngaycuoituanText = $dto->format("d-m-Y");
            if($i == $so_ngay_hoc_ky)
                $item .= '{' . '"tuanthu":' . '"t' . $i . '", "ngaydautuan":' . '"' . $ngaydautuan . '", "ngaycuoituan":' . '"' . $ngaycuoituan . '", "ngaydautuanText":' . '"' . $ngaydautuanText . '", "ngaycuoituanText":' . '"' . $ngaycuoituanText . '"' . '}';
            else $item .= '{' . '"tuanthu":' . '"t' . $i . '", "ngaydautuan":' . '"' . $ngaydautuan . '", "ngaycuoituan":' . '"' . $ngaycuoituan . '", "ngaydautuanText":' . '"' . $ngaydautuanText . '", "ngaycuoituanText":' . '"' . $ngaycuoituanText . '"' . '}' . ',';
            
            //array_push($tuan_hoc, $item);
            $dto->modify('+1 days');
            // echo $ngaydautuan . ' - ';
            // echo $ngaycuoituan;
            // echo "<br>";
        }

        //echo "<pre>";
        $tuan_hoc = "[" . $item . "]";
        return $tuan_hoc;
        //print_r($tuan_hoc);
    }
}
