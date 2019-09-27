<?php

namespace App\Http\Controllers;

use App\Device;
use App\Customer;
use Illuminate\Http\Request;

class DeviceController extends Controller
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
        $devices = Device::with('customer')->paginate(5);
        return $devices;
    }

    public function getCust()
    {
        $customers = Customer::select('id', 'firstname')->get();
        return $customers;
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
            'device_type' => 'required',
            'description' => 'sometimes',
            'location' => 'sometimes',
            'manufacture' => 'sometimes',
            'os' => 'sometimes',
            'model' => 'sometimes',
            'customer_id' => 'sometimes',
        ]);

        Device::create($data);

        return ['message' => 'Device created!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        //
        $data = request()->validate([
            'device_type' => 'required',
            'description' => 'sometimes',
            'location' => 'sometimes',
            'manufacture' => 'sometimes',
            'os' => 'sometimes',
            'model' => 'sometimes',
            'customer_id' => 'sometimes',
        ]);

        $device->update($data);
        return['message' => 'Device Updated!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        //
        $device->delete();

        return ['message' => 'Device Deleted!'];
    }
}
