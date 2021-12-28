<?php

namespace App\Http\Controllers;

use App\Models\sanpham;
use App\Models\nhanhieu;
use App\Models\chatlieu;
use App\Models\dactinh;
use App\Models\phanloai;
use App\Models\danhmuc;
use App\Models\size;
use App\Models\khuyenmai;
use App\Imports\sanpham_import;
use App\Exports\sanpham_export;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use File;
use Excel;

class sanpham_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data=sanpham::all();
        
        return view('admin.sanpham.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nhanhieu=nhanhieu::all();
        $size=size::all();
        $chatlieu=chatlieu::all();
        $phanloai=phanloai::all();
        $dactinh=dactinh::all();
        $danhmuc=danhmuc::all();
        $khuyenmai=khuyenmai::all();
        return view('admin.sanpham.create',compact('nhanhieu','chatlieu','phanloai','dactinh','danhmuc','khuyenmai','size'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->has('file_uploads')){
            
            $file=$request->file_uploads;
            $ex=$request->file_uploads->extension();
            $file_name=time().'-sanpham'.'.'.$ex;
            $file->move(public_path('uploads'),$file_name);

            $file1=$request->file_uploads1;
            $ex=$request->file_uploads1->extension();
            $file_name1=time().'-sanpham1'.'.'.$ex;
            $file1->move(public_path('uploads'),$file_name1);
          
        }
        $request->merge(['anh'=>$file_name]);
        $request->merge(['anh1'=>$file_name1]);

        if(sanpham::create($request->all())){
            return redirect('admin/sanpham');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nhanhieu=nhanhieu::all();
        $chatlieu=chatlieu::all();
        $phanloai=phanloai::all();
        $dactinh=dactinh::all();
        $danhmuc=danhmuc::all();
        $size=size::all();
        $khuyenmai=khuyenmai::all();
        $data=sanpham::find($id);
        return view('admin.sanpham.show',compact('data','nhanhieu','chatlieu','phanloai','dactinh','danhmuc','khuyenmai','size'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nhanhieu=nhanhieu::all();
        $chatlieu=chatlieu::all();
        $phanloai=phanloai::all();
        $dactinh=dactinh::all();
        $danhmuc=danhmuc::all();
        $size=size::all();
        $khuyenmai=khuyenmai::all();
        $data=sanpham::find($id);
        return view('admin.sanpham.edit',compact('data','nhanhieu','chatlieu','phanloai','dactinh','danhmuc','khuyenmai','size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->has('file_uploads')){
            $file=$request->file_uploads;
            $ex=$request->file_uploads->extension();
            $file_name=time().'-sanpham'.'.'.$ex;
            $file->move(public_path('uploads'),$file_name);

            $data=sanpham::find($id);
            File::delete('public/uploads/'.$data->anh);
            $request->merge(['anh'=>$file_name]); 
        } 
        elseif($request->has('file_uploads1')){
         $file1=$request->file_uploads1;
            $ex=$request->file_uploads1->extension();
            $file_name1=time().'-sanpham1'.'.'.$ex;
            $file1->move(public_path('uploads'),$file_name1);

            $data=sanpham::find($id);
            File::delete('public/uploads/'.$data->anh1);
            $request->merge(['anh1'=>$file_name1]);  
        }
    
        if(sanpham::find($id)->update($request->all())){
            return redirect('admin/sanpham');
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( sanpham::find($id)->dathang_chitiet->count()){
            return redirect()->route('sanpham.index')->with('error','không thể xóa sản phẩm vì sản phẩm có trong đơn hàng');
        }
        else{
            $data=sanpham::find($id);
            $duongdan = 'public/uploads';
            File::delete($duongdan.'/'.$data->anh);
            $data->delete();
            return redirect()->route('sanpham.index')->with('success','Xóa sản phẩm thành công');
        }
    }

    public function postNhap(Request $request)
    {
        Excel::import(new sanpham_import, $request->file('file_excel'));
        return redirect()->route('admin/sanpham');
    }

    public function getXuat()
    {
        return Excel::download(new sanpham_export, 'danh-sach-san-pham.xlsx');
    }
}
