<?php

namespace App\Http\Controllers;

use App\Models\khuyenmai;
use Illuminate\Http\Request;
use File;

class khuyenmai_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=khuyenmai::search()->paginate(5);
        return view('admin.khuyenmai.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.khuyenmai.create');
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
            $file_name=time().'-khuyenmai'.'.'.$ex;
            $file->move(public_path('uploads'),$file_name);
          
        }
        $request->merge(['hinhanh'=>$file_name]);

        if(khuyenmai::create($request->all())){
            return redirect('admin/khuyenmai');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\khuyenmai  $khuyenmai
     * @return \Illuminate\Http\Response
     */
    public function show(khuyenmai $khuyenmai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\khuyenmai  $khuyenmai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = khuyenmai::find($id);
		return view('admin.khuyenmai.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\khuyenmai  $khuyenmai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->has('file_uploads')){
            $file=$request->file_uploads;
            $ex=$request->file_uploads->extension();
            $file_name=time().'-khuyenmai'.'.'.$ex;
            $file->move(public_path('uploads'),$file_name);

            $data=khuyenmai::find($id);
            File::delete('public/uploads/'.$data->hinhanh);
            $request->merge(['hinhanh'=>$file_name]); 
        }
    
        if(khuyenmai::find($id)->update($request->all())){
            return redirect('admin/khuyenmai');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\khuyenmai  $khuyenmai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=khuyenmai::find($id);
        $duongdan = 'public/uploads';
        File::delete($duongdan.'/'.$data->hinhanh);
        $data->delete();
        if( $data)
            return redirect('admin/khuyenmai');
    }
}
