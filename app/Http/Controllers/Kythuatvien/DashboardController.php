<?php
namespace App\Http\Controllers\Kythuatvien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kythuatvien;
use App\Models\Lichtruc;
use DB;
use Auth;

// session_start();
// $_SESSION['kythuatvien_id'] = Auth::guard('kythuatvien')->id();

class DashboardController extends Controller
{
    protected $kythuatvien_current_id;

    public function __construct() {
        $this->kythuatvien_current_id = Auth::guard('kythuatvien')->id();
    }

    public function index()
    {
    	//$id_current = Auth::kythuatvien()->id;
    	//echo $id_current;
    	// $id_current =
    	// $ktv = Kythuatvien::find($id_current);
    	// $ktv->status = 1;
    	// $ktv->save();
     //    print_r($id_current);
        $kythuatvien_current = Auth::guard('kythuatvien')->id();
        $kythuatvien = Kythuatvien::find($kythuatvien_current);
        $kythuatvien->status = 1;
        $kythuatvien->save();
        //print_r($this->kythuatvien_current_id);
        //return view('kythuatvien.index');
        return view('home-kythuatvien', compact('kythuatvien_current'));
    }

    public function lichtrucHockyKTV($hocky_id, $kythuatvien_current_id) {
        //return $kythuatvien_current_id;
        $data = DB::select('
                    SELECT chitiet_truc.id, chitiet_truc.ca_id, chitiet_truc.thu_id, kythuatvien.name, chitiet_truc.hocky_id
                    FROM (((chitiet_truc JOIN hocky ON chitiet_truc.hocky_id = hocky.id)
                    JOIN thu ON chitiet_truc.thu_id = thu.id) JOIN ca ON chitiet_truc.ca_id = ca.id)
                    JOIN kythuatvien ON chitiet_truc.kythuatvien_id = kythuatvien.id
                    WHERE hocky_id = ? and kythuatvien.id = ?' , [$hocky_id, $kythuatvien_current_id]
                );
        return $data;
    }
}
