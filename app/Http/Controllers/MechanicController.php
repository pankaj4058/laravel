<?php

namespace App\Http\Controllers;

use App\Models\mechanic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mechanics;

class MechanicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $mechanic = mechanics::find(1);

             $data['owner'] = $mechanic->carowner->name;
             $data['car'] = $mechanic->car->model;
        //    echo "<pre>";
        //         print_r($data);
        //         die;


            return view('mechanic.index',$data);
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
     * @param  \App\Models\mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function show(mechanic $mechanic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function edit(mechanic $mechanic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mechanic $mechanic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function destroy(mechanic $mechanic)
    {
        //
    }
}
