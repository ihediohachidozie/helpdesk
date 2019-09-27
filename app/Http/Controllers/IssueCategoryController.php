<?php

namespace App\Http\Controllers;

use App\IssueCategory;
use Illuminate\Http\Request;

class IssueCategoryController extends Controller
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
        $issueCategories = IssueCategory::paginate(5);
        
        return $issueCategories;
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
        ]);

        Issuecategory::create($data);

        return ['message' => 'Issue Category created!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IssueCategory  $issueCategory
     * @return \Illuminate\Http\Response
     */
    public function show(IssueCategory $issueCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IssueCategory  $issueCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(IssueCategory $issueCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IssueCategory  $issueCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IssueCategory $issueCategory)
    {
        //
        $data = request()->validate([
            'name' => 'required'
        ]);

        $issueCategory->update($data);
        return['message' => 'Issue Category Updated!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IssueCategory  $issueCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueCategory $issueCategory)
    {
        //
        $issueCategory->delete();

        return ['message' => 'Issue Category Deleted!'];
    }
}
