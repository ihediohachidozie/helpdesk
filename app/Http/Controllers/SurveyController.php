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

    public function getAll()
    {
        return Survey::paginate(5);
    }
    public function getMonth($id)
    {
        // get survey based on particular satisfaction level & month for the year
        return Survey::whereMonth('created_at', $id)->whereYear('created_at', date('Y'))->paginate(5);

    }
    public function getLevel($id)
    {
        // get survey based on particular satisfaction level for the current month & year
        return Survey::where('satisfaction', $id)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->paginate(5);

    }

    public function getSurvey($id)
    {
        //$s = survey::whereMonth('created_at', '9')->groupBy('statisfaction')->count();
       // return DB::table('surveys')->select('satisfaction', DB::raw('count(satisfaction) as survey_count'))->whereMonth('created_at', $id)->groupBy('satisfaction')->get();
        
        $terrible = survey::where('satisfaction', 0)->whereMonth('created_at', $id)->count();
        
        $bad = survey::where('satisfaction', 1)->whereMonth('created_at', $id)->count();
        
        $okay = survey::where('satisfaction', 2)->whereMonth('created_at', $id)->count();
        
        $good = survey::where('satisfaction', 3)->whereMonth('created_at', $id)->count();
        
        $great = survey::where('satisfaction', 4)->whereMonth('created_at', $id)->count();

        return [$terrible, $bad, $okay, $good, $great];


    }
}
