<?php

namespace App\Http\Controllers;

use App\dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(auth()->user()->roles);
        $title = 'Bienvenido';
        $ruta = json_decode('[["Home", "/dashboard"]]', true);
        return view('dashboard', compact('ruta', 'title'));
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
     * @param  \App\dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(dashboard $dashboard)
    {
        //
    }
}
