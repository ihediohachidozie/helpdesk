<?php

namespace App\Http\Controllers;

use App\Survey;
use DB;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('survey');
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
        $data = request()->validate([
            'satisfaction' => 'required',
            'comment' => 'sometimes'
        ]);
        $survey = Survey::create($data);
       
        return view('thankyou');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
        //$s = DB::table('surveys')->select('satisfaction', DB::raw('count(satisfaction) as survey_count'))->whereMonth('created_at', $id)->groupBy('satisfaction')->get();
        //return $s;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }

    public function getSurvey($id)
    {
        //$s = survey::whereMonth('created_at', '9')->groupBy('statisfaction')->count();
         return DB::table('surveys')->select('satisfaction', DB::raw('count(satisfaction) as survey_count'))->whereMonth('created_at', $id)->groupBy('satisfaction')->get();
        return $s;
    }
}
