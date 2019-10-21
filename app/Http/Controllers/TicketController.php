<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\User;
use DB;
use App\Customer;
use App\IssueCategory;
use Illuminate\Http\Request;
use App\Mail\ticketClosed;
use App\Mail\ticketOpen;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
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
        $tickets = Ticket::with('customer')->latest()->paginate(5);

        return $tickets;
    }

    public function getUsers()
    {
        $users = User::get();
        return $users;

    }

    public function getPrority()
    {
        return $proprity = [
            0 => 'Low',
            1 => 'Medium',
            2 => 'High'
        ];
    }

    public function getStatus()
    {
        return $status = [
            0 => 'Open',
            1 => 'In-Progress',
            2 => 'Closed'
        ];
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

    private function validateData()
    {
        return request()->validate([
            'summary' => 'required',
            'description' => 'required',
            'issuecategory_id' => 'required',
            'customer_id' => 'required',
            'user_id' => 'required',
            'prority' => 'required',
            'status' => 'required',
            'related' => 'sometimes',
            'resolution' => 'sometimes'
        ]);

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
        Ticket::create($this->validateData());

        $ticket_id = Ticket::where('user_id', $request->user_id)->latest()->take(1)->get('id');

        // send mail on ticket created!
        $customer = Customer::findOrFail($request->customer_id);

        $when = now()->addMinutes(10);

        $summary = $request->summary;

        $email = $customer->email;

        Mail::to($email)->later($when, new ticketOpen($customer, $summary, $ticket_id));

        return ['message' => 'Ticket created!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
        return Ticket::where('issuecategory_id', '=', $ticket)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
        //$data = $this.validateData();
        $ticket_id = $request->ticket_id;

        $ticket->update($this->validateData());

        if($request->status == 2)
        {
            $customer = Customer::find($request->customer_id);

            $when = now()->addMinutes(10);

            $email = $customer->email;

            // Mail::to($customer->email)->later($when, new ticketClosed($customer, $request->summary, $ticket_id));
            Mail::to($email)->later($when, new ticketClosed($customer, $request->summary, $ticket_id));
        }
        
        return['message' => 'Ticket Updated!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
        $ticket->delete();  

        return ['message' => 'Ticket Deleted!'];
    }

    public function getCust()
    {
        return Customer::select('id', 'firstname')->get();
    }
    public function getCat()
    {
        return IssueCategory::get();
    }
    public function getSearch($id, $search)
    {
        // search tickets by category 
        if($search == 'Category')
        {
            return Ticket::with('customer')->where('issuecategory_id',  $id)->paginate(5);
        }
        elseif($search == 'Customer')
        {
            return Ticket::with('customer')->where('customer_id',  $id)->paginate(5);
        }
        
    }
    public function getBoth($x, $y)
    {
        // search tickets by custmoer & category
       return Ticket::with('customer')
                ->where('issuecategory_id', $x)
                ->where('customer_id',  $y)
                ->paginate(5);

    }
    public function openTickets()
    {
        $open = Ticket::where('status', 0)->count();

        $wip = Ticket::where('status', 1)->count();

        $closed = Ticket::where('status', 2)->count();

       // $status = [$opn, $wip, $closed];  
        return [ $open, $wip, $closed ];
    }
    public function getAgents()
    {
        $a = DB::table('tickets')->leftJoin('users', 'users.id', '=', 'tickets.user_id')->select('user_id','users.username', DB::raw('count(status) as resolved'))->groupBy('user_id')->get();
        // $a = DB::table('tickets')->select('user_id', DB::raw('count(status) as resolved'))->where('status', 2)->groupBy('user_id')->get();
        return $a;
    }

    public function getOpenTickets()
    {
        return Ticket::with('customer')->where('status', 0)->latest()->paginate(5);
    }

    public function getWIPTickets()
    {
        return Ticket::with('customer')->where('status', 1)->latest()->paginate(5);
    }

    public function getClosedTickets()
    {
        return Ticket::with('customer')->where('status', 2)->latest()->paginate(5);
    }



}   
