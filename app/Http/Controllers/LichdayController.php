<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lichday;
use App\Models\Lop;
use App\Models\Nhomlop;
use App\Models\Monhoc;
use App\Models\Giangvien;
use App\Models\Phongmay;
use App\Models\Ca;
use Excel;
use DB;
use Hash;

class LichdayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->getLichday();
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
        // $file = $request->fileExcel;

        // $name =  $file->getClientOriginalName();
        // $file->move(public_path('uploads\excel'), $name);
        $hocky_id = $request->hocky_id;

        $hockyExists = DB::table('chitiet_lichday')->where('hocky_id', $hocky_id)->first();

        if($hockyExists != '' && $request->tieptuc != 'yes') {
            return response()->json(['warn' => 'Học kỳ này đã được import lịch. Nếu nhấn Yes dữ liệu cũ của học kỳ này sẽ được thay thế bằng dữ liệu mới'], 200);
            exit;
        }
        
        if($request->tieptuc == 'yes') 
            DB::table('chitiet_lichday')->where('hocky_id', $hocky_id)->delete();

        if($request->hasFile('fileExcel')) {
            $path = $request->file('fileExcel')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if(!empty($data) && $data->count()) {
                foreach ($data as $key => $row) {
                    //print_r($row);
                    $nhomlop_id = '';
                    $nhomlop = Nhomlop::where('nhomlop', str_replace('_x000D_', ' ', $row->f_malps))->where('hocky_id', $hocky_id)->first();
                    //print_r($nhomlop);
                    if($nhomlop == '') {
                        $newNhomlop = new Nhomlop;
                        $newNhomlop->nhomlop = str_replace('_x000D_', ' ', $row->f_malps); //$row->f_malps; 
                        $newNhomlop->siso = $row->f_sisoctgh;
                        $newNhomlop->hocky_id = $hocky_id;
                        $newNhomlop->save();
                        $nhomlop_id = $newNhomlop->id;
                    } else $nhomlop_id = $nhomlop->id;

                    $giangvien_id = '';
                    $giangvien = Giangvien::where('magiangvien', $row->f_manv)->first();
                    if($giangvien == '') {
                        $newGiangvien = new Giangvien;
                        $newGiangvien->magiangvien = $row->f_manv;
                        $newGiangvien->username = $row->f_holotcbv . ' ' . $row->f_tencbv ;
                        $newGiangvien->password = Hash::make($row->f_manv);;
                        $newGiangvien->status = 0;
                        $newGiangvien->save();
                        $giangvien_id = $newGiangvien->id;
                    } else $giangvien_id =  $giangvien->id;

                    $monhoc_id = '';
                    $monhoc = Monhoc::where('mamonhoc', $row->f_mamh)->first();
                    if($monhoc == '') {
                        $newMonhoc = new Monhoc;
                        $newMonhoc->mamonhoc = $row->f_mamh;
                        $newMonhoc->tenmonhoc = $row->f_tenmhvn;
                        
                        $thoigianhoc = explode('-', $row->f_lichin);
                        $newMonhoc->ngaybatdau = $this->editTypeDate($thoigianhoc[0]);
                        $newMonhoc->ngayketthuc = $this->editTypeDate($thoigianhoc[1]);
                        
                        $newMonhoc->save();
                        $monhoc_id = $newMonhoc->id;
                    } else $monhoc_id =  $monhoc->id; // Trong truong hop hoc ky moi thi ngay bat dau mon hoc se thay doi vi vay can lam them cap nhat cho ngay cho monhoc

                    $phongmay = Phongmay::where('tenphongmay', $row->f_tenph)->first();
                    $phongmay_id = $phongmay->id;

                    $thu_id = $row->f_thu; 

                    $tuanso = '';
                    for($i = 1; $i <= 60; $i++) {
                        $tuan = 't' . $i;
                        if($i == 60) $tuanso .= '"t' . $i . '"' . ':' . '"' . $row[$tuan] . '"'; 
                        else $tuanso .= '"t' . $i . '"' . ':' . '"' . $row[$tuan] . '"' . ','; 
                    }
                    $tuanhoc = "{" . $tuanso . "}";

                    $sotiethoc = $row->f_tiethoc;
                    if($sotiethoc == '-23456---------') {
                        for($i = 1; $i <= 2; $i++) {
                            $ca_id = $i;
                            $this->addLichday([
                                'hocky_id'=> $hocky_id,
                                'thu_id'=> $thu_id,
                                'ca_id'=> $ca_id,
                                'nhomlop_id'=> $nhomlop_id,
                                'monhoc_id'=> $monhoc_id,
                                'phongmay_id'=> $phongmay_id,
                                'giangvien_id'=> $giangvien_id,
                                'tuanhoc'=> $tuanhoc
                            ]);
                        }

                    } else if($sotiethoc == '------78901----') {
                        for($i = 3; $i <= 4; $i++) {
                            $ca_id = $i;
                            $this->addLichday([
                                'hocky_id'=> $hocky_id,
                                'thu_id'=> $thu_id,
                                'ca_id'=> $ca_id,
                                'nhomlop_id'=> $nhomlop_id,
                                'monhoc_id'=> $monhoc_id,
                                'phongmay_id'=> $phongmay_id,
                                'giangvien_id'=> $giangvien_id,
                                'tuanhoc'=> $tuanhoc
                            ]);
                        }
                    } else {
                        $ca = Ca::where('tietso', $sotiethoc)->first();
                        $ca_id = $ca->id;
                        $this->addLichday([
                            'hocky_id'=> $hocky_id,
                            'thu_id'=> $thu_id,
                            'ca_id'=> $ca_id,
                            'nhomlop_id'=> $nhomlop_id,
                            'monhoc_id'=> $monhoc_id,
                            'phongmay_id'=> $phongmay_id,
                            'giangvien_id'=> $giangvien_id,
                            'tuanhoc'=> $tuanhoc
                        ]);
                    }
                }
            }
        }

        // $kythuatvien->image = $name;
        // $kythuatvien->save();
        return response()->json(['success' => 'Import thành công'], 200);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function editTypeDate($thoigianhoc) {
        $date = explode('/', $thoigianhoc);
        $afterEdit = $date[2] . '-' . $date[1] . '-' . $date[0]; //YYYY-mm-dd
        return $afterEdit;
    }

    protected function addLichday($lichdayArr = []) {
        $lichday = new Lichday;
        $lichday->hocky_id = $lichdayArr['hocky_id'];
        $lichday->thu_id = $lichdayArr['thu_id']; 
        $lichday->ca_id = $lichdayArr['ca_id'];
        $lichday->nhomlop_id = $lichdayArr['nhomlop_id']; 
        $lichday->monhoc_id = $lichdayArr['monhoc_id']; 
        $lichday->phongmay_id = $lichdayArr['phongmay_id'];
        $lichday->giangvien_id = $lichdayArr['giangvien_id'];
        $lichday->tuanhoc = $lichdayArr['tuanhoc'];
        $lichday->save();
    }

    protected function getAllLichday() {
        $data = DB::select('SELECT
                                chitiet_lichday.id as chitiet_lichday_id, 
                                phongmay.id as phongmay_id, phongmay.tenphongmay, 
                                giangvien.id as giangvien_id, giangvien.username, 
                                thu.id as thu_id, thu.tenthu, 
                                ca.id as ca_id, ca.tenca, 
                                nhomlop.id as nhomlop_id, nhomlop.nhomlop, 
                                monhoc.id as monhoc_id, monhoc.tenmonhoc, 
                                hocky.id as hocky_id, hocky.tenhocky, 
                                chitiet_lichday.tuanhoc 
                            FROM ((((((chitiet_lichday JOIN phongmay ON chitiet_lichday.phongmay_id = phongmay.id)
                            JOIN giangvien ON giangvien.id = chitiet_lichday.giangvien_id)
                            JOIN thu ON thu.id = chitiet_lichday.thu_id)
                            JOIN ca ON ca.id = chitiet_lichday.ca_id)
                            JOIN nhomlop ON nhomlop.id = chitiet_lichday.nhomlop_id)
                            JOIN monhoc ON monhoc.id = chitiet_lichday.monhoc_id)
                            JOIN hocky on hocky.id = chitiet_lichday.hocky_id
                ');
        return $data;
    }

    public function getHockyCaLichday($hocky, $phongmay) {
        $data = DB::select(' SELECT 
                phongmay.id as phongmay_id, phongmay.tenphongmay, 
                giangvien.id as giangvien_id, giangvien.username as tengiangvien, 
                thu.id as thu_id, thu.tenthu, 
                ca.id as ca_id, ca.tenca, 
                nhomlop.id as nhomlop_id, nhomlop.nhomlop, 
                monhoc.id as monhoc_id, monhoc.tenmonhoc, 
                hocky.id as hocky_id, hocky.tenhocky, 
                chitiet_lichday.tuanhoc 
            FROM ((((((chitiet_lichday JOIN phongmay ON chitiet_lichday.phongmay_id = phongmay.id)
            JOIN giangvien ON giangvien.id = chitiet_lichday.giangvien_id)
            JOIN thu ON thu.id = chitiet_lichday.thu_id)
            JOIN ca ON ca.id = chitiet_lichday.ca_id)
            JOIN nhomlop ON nhomlop.id = chitiet_lichday.nhomlop_id)
            JOIN monhoc ON monhoc.id = chitiet_lichday.monhoc_id)
            JOIN hocky on hocky.id = chitiet_lichday.hocky_id
            WHERE hocky.id = ? AND phongmay.id = ?
        ', [$hocky, $phongmay]);
        return $data;
    }

    public function getLichdayGV($hocky_id, $giangvien_current_id) {
        $data = DB::select(' SELECT 
                phongmay.id as phongmay_id, phongmay.tenphongmay, 
                giangvien.id as giangvien_id, giangvien.username as tengiangvien, 
                thu.id as thu_id, thu.tenthu, 
                ca.id as ca_id, ca.tenca, 
                nhomlop.id as nhomlop_id, nhomlop.nhomlop, 
                monhoc.id as monhoc_id, monhoc.tenmonhoc, 
                hocky.id as hocky_id, hocky.tenhocky, 
                chitiet_lichday.tuanhoc 
            FROM ((((((chitiet_lichday JOIN phongmay ON chitiet_lichday.phongmay_id = phongmay.id)
            JOIN giangvien ON giangvien.id = chitiet_lichday.giangvien_id)
            JOIN thu ON thu.id = chitiet_lichday.thu_id)
            JOIN ca ON ca.id = chitiet_lichday.ca_id)
            JOIN nhomlop ON nhomlop.id = chitiet_lichday.nhomlop_id)
            JOIN monhoc ON monhoc.id = chitiet_lichday.monhoc_id)
            JOIN hocky on hocky.id = chitiet_lichday.hocky_id
            WHERE hocky.id = ? AND giangvien.id = ?
        ', [$hocky_id, $giangvien_current_id]);
        return $data;
    }
}
