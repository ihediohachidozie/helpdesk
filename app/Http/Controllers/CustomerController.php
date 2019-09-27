<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Customer;

class CustomerController extends Controller
{
    //
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
        $customers = Customer::with('department')->paginate(5);

        return $customers;
    }

    public function getDept()
    {
        $departments = Department::select('id', 'name')->get();
        return $departments;
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
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'job_title' => 'sometimes',
            'department_id' => 'required',
        ]);

        Customer::create($data);

        return ['message' => 'Customer created!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
         $data = request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'job_title' => 'sometimes',
            'department_id' => 'required',
        ]);

        $customer->update($data);

        return['message' => 'Customer Updated!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
        $customer->delete();

        return ['message' => 'Customer Deleted!'];
    }
}
