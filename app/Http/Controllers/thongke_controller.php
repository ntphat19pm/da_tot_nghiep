<?php

namespace App\Http\Controllers;

use App\Models\thongke;
use App\Models\dathang_chitiet;
use App\Models\dathang;
use Illuminate\Http\Request;

class thongke_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=thongke::orderby('ngaydathang','DESC')->get();
        
        return view('admin.thongke.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=dathang_chitiet::orderby('id','DESC')->get();
        return view('admin.thongke.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new thongke;
        $data->ngaydathang=$request->ngaydathang;
        $data->doanh_so=$request->doanh_so;
        $data->doanh_thu=$request->doanh_thu;
        $data->loi_nhuan=$request->loi_nhuan;
        $data->soluong_ban=$request->soluong_ban;
        $data->tong_donhang=$request->tong_donhang;
    
       if($data->save()) {
           return redirect('admin/thongke');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\thongke  $thongke
     * @return \Illuminate\Http\Response
     */
    public function show(thongke $thongke)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\thongke  $thongke
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thongke=thongke::find($id);
        $data=dathang_chitiet::orderby('id','DESC')->get();
        return view('admin.thongke.edit',compact('data','thongke'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\thongke  $thongke
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=thongke::find($id);
        $data->ngaydathang=$request->ngaydathang;
        $data->doanh_so=$request->doanh_so;
        $data->doanh_thu=$request->doanh_thu;
        $data->loi_nhuan=$request->loi_nhuan;
        $data->soluong_ban=$request->soluong_ban;
        $data->tong_donhang=$request->tong_donhang;
    
       if($data->save()) {
           return redirect('admin/thongke');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\thongke  $thongke
     * @return \Illuminate\Http\Response
     */
    public function destroy(thongke $thongke)
    {
        //
    }
}
