<?php

namespace App\Http\Controllers;

use App\Models\Feladatok;
use Illuminate\Http\Request;

class FeladatokController extends Controller
{
    public function feladatok(){
        $fdt=Feladatok::all();
        return $fdt;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Feladatok  $feladatok
     * @return \Illuminate\Http\Response
     */
    public function show(Feladatok $feladatok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feladatok  $feladatok
     * @return \Illuminate\Http\Response
     */
    public function edit(Feladatok $feladatok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feladatok  $feladatok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feladatok $feladatok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feladatok  $feladatok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feladatok $feladatok)
    {
        //
    }
}
