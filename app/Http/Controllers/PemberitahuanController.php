<?php

namespace App\Http\Controllers;

use App\Models\Pemberitahuan;
use Illuminate\Http\Request;

class PemberitahuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewPemberitahuan()
    {
        $pemberitahuans = Pemberitahuan::latest()->get();
        return view('admin.pemberitahuan', compact('pemberitahuans'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemberitahuan  $pemberitahuan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemberitahuan $pemberitahuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemberitahuan  $pemberitahuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemberitahuan $pemberitahuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemberitahuan  $pemberitahuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemberitahuan $pemberitahuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemberitahuan  $pemberitahuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemberitahuan $pemberitahuan)
    {
        //
    }
}
