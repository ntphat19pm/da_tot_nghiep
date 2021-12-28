<?php

namespace App\Http\Controllers;

use App\Models\chatlieu;
use Illuminate\Http\Request;

class chatlieu_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=chatlieu::search()->paginate(5);
        return view('admin.chatlieu.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.chatlieu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new chatlieu;
        $data->chatlieu=$request->chatlieu;
        $data->slug=str_slug($request->chatlieu);
        if($data->save()){
            return redirect('admin/chatlieu');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\chatlieu  $chatlieu
     * @return \Illuminate\Http\Response
     */
    public function show(chatlieu $chatlieu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chatlieu  $chatlieu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=chatlieu::find($id);
        return view('admin.chatlieu.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\chatlieu  $chatlieu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data=chatlieu::find($id);
        $data->chatlieu=$request->chatlieu;
        $data->slug=str_slug($request->chatlieu);
        if($data->save()){
            return redirect('admin/chatlieu');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chatlieu  $chatlieu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=chatlieu::find($id)->delete();
        if($data){
            return redirect('admin/chatlieu');
        }
    }
}
