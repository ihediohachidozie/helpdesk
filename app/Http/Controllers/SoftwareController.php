<?php

namespace App\Http\Controllers;

use App\Software;
use Illuminate\Http\Request;

class SoftwareController extends Controller
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
        //
        $software = Software::paginate(5);
        return $software;
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
        $data = request()->validate([
            'name' => 'required',
            'license' => 'sometimes',
            'version' => 'sometimes',
            'manufacturer' => 'sometimes',
            'expire_date' => 'sometimes',
        ]);

        Software::create($data);

        return ['message' => 'Software created!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function show(Software $software)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function edit(Software $software)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Software $software)
    {
        //
        $data = request()->validate([
            'name' => 'required',
            'license' => 'sometimes',
            'version' => 'sometimes',
            'manufacturer' => 'sometimes',
            'expire_date' => 'sometimes',
        ]);

        $software->update($data);
        return['message' => 'Software Updated!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function destroy(Software $software)
    {
        //
        $software->delete();

        return ['message' => 'Software Deleted!'];
    }
}
