<?php
// app/Repositories/Eloquents/ProductRepository.php

namespace App\Repositories\Eloquents;
use App\Repositories\Contracts\HockyRepositoryInterface;

use Illuminate\Http\Request;
use App\Models\Hocky;
use App\Models\Lichtruc;
use App\Models\Lichday;
use DateTime;
use DB;

class HockyRepository implements HockyRepositoryInterface
{

    private $hocky;

    public function __construct() {
        $this->hocky = new Hocky();
    }

    public function all() {
        return $this->hocky->orderBy('id','DESC')->get();
    }

    public function find($id) {
        return $this->hocky->find($id);
    }

    public function add(array $data) {
        $hocky = $this->hocky->where('tenhocky', $data['tenhocky'])->where('namhoc', $data['namhoc'])->count();
        if($hocky != 0)
            return 'error';
        else {
            $this->hocky->create($data);
            return 'success';
        }    
    }

    public function edit(array $data, $id) {
        $hocky = $this->hocky->find($id);
        $hockyExists = 0;

        if($hocky->tenhocky == $data['tenhocky'] && $hocky->namhoc == $data['namhoc'])
            $hockyExists = 0;
        if($hocky->tenhocky != $data['tenhocky'] || $hocky->namhoc != $data['namhoc'])
            $hockyExists = $this->hocky->where('tenhocky', $data['tenhocky'])->where('namhoc', $data['namhoc'])->count();
        
        if($hockyExists != 0)
            return 'error';
        else {
            $hocky->tenhocky = $data['tenhocky'];
            $hocky->namhoc = $data['namhoc'];
            $hocky->ngaybatdau = $data['ngaybatdau'];
            $hocky->ngayketthuc = $data['ngayketthuc'];
            $hocky->save();
            return 'success';
        }
    }

    public function remove($id) {
        // echo $id . "<br>";
        $lichtruc = Lichtruc::where('hocky_id', $id)->count();
        $lichday = Lichday::where('hocky_id', $id)->count();
        // echo $lichtruc . "<br>";
        // echo $lichday . "<br>";
        if($lichtruc != 0 || $lichday != 0) 
            return 'error';
        else {
            $this->hocky->destroy($id);
            return 'success';
        }    
            
    }

    public function tuanhoc($hocky_id) {
        $hocky = Hocky::where('id', $hocky_id)->first();
        $ngaybatdau = new DateTime($hocky->ngaybatdau);
        $ngayketthuc = new DateTime($hocky->ngayketthuc);

        $interval  = date_diff($ngaybatdau, $ngayketthuc);
        $so_ngay_hoc_ky = ($interval ->days + 1) / 7;

        $dto = $ngaybatdau;
        $item = '';

        for($i = 1; $i <= $so_ngay_hoc_ky; $i++) {
            $ngaydautuan = $dto->format("Y-m-d");
            $ngaydautuanText = $dto->format("d-m-Y");
            $dto->modify('+6 days');
            $ngaycuoituan = $dto->format("Y-m-d");
            $ngaycuoituanText = $dto->format("d-m-Y");
            if($i == $so_ngay_hoc_ky)
                $item .= '{' . '"tuanthu":' . '"t' . $i . '", "ngaydautuan":' . '"' . $ngaydautuan . '", "ngaycuoituan":' . '"' . $ngaycuoituan . '", "ngaydautuanText":' . '"' . $ngaydautuanText . '", "ngaycuoituanText":' . '"' . $ngaycuoituanText . '"' . '}';
            else $item .= '{' . '"tuanthu":' . '"t' . $i . '", "ngaydautuan":' . '"' . $ngaydautuan . '", "ngaycuoituan":' . '"' . $ngaycuoituan . '", "ngaydautuanText":' . '"' . $ngaydautuanText . '", "ngaycuoituanText":' . '"' . $ngaycuoituanText . '"' . '}' . ',';

            $dto->modify('+1 days');
        }

        $tuan_hoc = "[" . $item . "]";
        return $tuan_hoc;
    }
}