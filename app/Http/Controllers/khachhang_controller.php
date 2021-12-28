<?php

namespace App\Http\Controllers;

use App\Models\khachhang;
use Illuminate\Http\Request;

class khachhang_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=khachhang::orderBy('id','ASC')->search()->paginate(10);
        return view('admin.khachhang.index',compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.khachhang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new khachhang;
        $data->hovaten=$request->hovaten;
        $data->gioitinh=$request->gioitinh;
        $data->sdt=$request->sdt;
        $data->cmnd=$request->cmnd;
        $data->ngaysinh=$request->ngaysinh;
        $data->diachi=$request->diachi;
        $data->email=$request->email;
        $data->tendangnhap=$request->tendangnhap;
        $data->password=bcrypt($request->password);

        if($data->save()){
            $data=khachhang::all();
            return view('admin.khachhang.index',compact('data'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\khachhang  $khachhang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = khachhang::find($id);
        
		return view('admin.khachhang.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\khachhang  $khachhang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = khachhang::find($id);
        
		return view('admin.khachhang.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\khachhang  $khachhang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data = khachhang::find($id);
        $data->hovaten=$request->hovaten;
        $data->gioitinh=$request->gioitinh;
        $data->sdt=$request->sdt;
        $data->cmnd=$request->cmnd;
        $data->ngaysinh=$request->ngaysinh;
        $data->diachi=$request->diachi;
        $data->email=$request->email;
        $data->tendangnhap=$request->tendangnhap;
        $data->password=bcrypt($request->password);
        if($data->save()){
            $data=khachhang::all();
            return view('admin.khachhang.index',compact('data'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\khachhang  $khachhang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        khachhang::find($id)->delete();

        return redirect('admin/khachhang');
        
    }
}
