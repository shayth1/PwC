<?php

namespace App\Http\Controllers;

use App\Models\WorkOn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WorkOnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id)
    {
        // $data = WorkOn::join('state', 'state.country_id', '=', 'country.country_id')
        //     ->join('city', 'city.state_id', '=', 'state.state_id')
        //     ->get(['country.country_name', 'state.state_name', 'city.city_name']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'employee_id' => 'required'

        ]);

        return WorkOn::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($assign_id)
    {
        return WorkOn::destroy($assign_id);
    }
}