<?php

namespace App\Http\Controllers;

use App\Models\dactinh;
use Illuminate\Http\Request;

class dactinh_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=dactinh::orderBy('id','ASC')->search()->paginate(10);
        return view('admin.dactinh.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dactinh.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new dactinh;
        $data->dactinh=$request->dactinh;
        $data->slug=str_slug($request->dactinh);
        if($data->save()){
            return redirect('admin/dactinh');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dactinh  $dactinh
     * @return \Illuminate\Http\Response
     */
    public function show(dactinh $dactinh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dactinh  $dactinh
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=dactinh::find($id);
        return view('admin.dactinh.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dactinh  $dactinh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data=dactinh::find($id);
        $data->dactinh=$request->dactinh;
        $data->slug=str_slug($request->dactinh);
        if($data->save()){
            return redirect('admin/dactinh');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dactinh  $dactinh
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=dactinh::find($id)->delete();
        if($data){
            return redirect('admin/dactinh');
        }
    }
}
