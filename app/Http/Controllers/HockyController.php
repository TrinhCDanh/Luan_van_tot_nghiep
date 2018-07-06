<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Hocky;
// use DateTime;
use App\Repositories\Contracts\HockyRepositoryInterface;

class HockyController extends Controller
{
    protected $hockyRepository;

    public function __construct(HockyRepositoryInterface $hockyRepository)
    {
        $this->hockyRepository = $hockyRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->hockyRepository->all();
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
        $add = $this->hockyRepository->add($request->all());
        if($add == "error")
            return response()->json(['error' => 'Học kỳ này đã tồn tại'], 200);
        else
            return response()->json(['success' => 'Thêm thành công'], 200);
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
        return $this->hockyRepository->find($id);
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
        $edit = $this->hockyRepository->edit($request->all(), $id);
        if($edit == "error")
            return response()->json(['error' => 'Học kỳ này đã tồn tại'], 200);
        else
            return response()->json(['success' => 'Thêm thành công'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $remove = $this->hockyRepository->remove($id);
        if($remove == "error")
            return response()->json(['error' => 'Không xóa được học kỳ này'], 200);
        else
            return response()->json(['success' => 'Xóa thành công'], 200);
    }

    public function tuanhoc($hocky_id) {
        return $this->hockyRepository->tuanhoc($hocky_id);
    }
}
