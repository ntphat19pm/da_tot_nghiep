<?php

namespace App\Http\Controllers;

use App\Models\phanloai;
use Illuminate\Http\Request;

class phanloai_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=phanloai::orderBy('id','ASC')->search()->paginate(10);
        return view('admin.phanloai.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.phanloai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new phanloai;
        $data->phanloai=$request->phanloai;
        $data->slug=str_slug($request->phanloai);
        if($data->save()){
            $data=phanloai::all();
            return redirect('admin/phanloai');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\phanloai  $phanloai
     * @return \Illuminate\Http\Response
     */
    public function show(phanloai $phanloai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\phanloai  $phanloai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = phanloai::find($id);
        
		return view('admin.phanloai.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\phanloai  $phanloai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = phanloai::find($id);
        $data->phanloai=$request->phanloai;
        $data->slug=str_slug($request->phanloai);
        if($data->save()){
            $data=phanloai::all();
            return redirect('admin/phanloai');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\phanloai  $phanloai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= phanloai::find($id)->delete();
       if( $data)
            return redirect('admin/phanloai');
    }
}
