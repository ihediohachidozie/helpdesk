<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
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
        $user = User::find(auth()->id())->get(['id', 'name', 'email', 'image']);

        return $user;
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

        $user = User::findorfail(auth()->id());

        $data = request()->validate([
            'image' => 'sometimes|file|image|max:5000',
        ]); 

        $user->update($data);

     //   $imageName = time().'.'.$request->image->getClientOriginalExtension();
      //  $request->image->move(public_path('images'), $imageName);
                
        if(request()->has('image')){
            auth()->user()->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);

            $image = Image::make(('storage/'. auth()->user()->image))->fit(300, 300);

            $image->save();
        }

      //  $user->update($data);

      //  $this->storeImage();

        $msg ='Profile Image uploaded successfully.';
        
      //  
      //  
         
        

        return['message' => $msg];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::findorfail(auth()->id());
        
        if($request->has('name'))
        {
            $data = request()->validate([
                'name' => 'required',
                'email' => 'required'
            ]);
            $msg = 'User Updated.';
        }
        elseif($request->has('password'))
        {
            $data = request()->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed|min:6|different:current_password',
                'password_confirmation' => 'required',
            ]);

    
            if(Hash::check($request->get('current_password'), $user->password)){
                $data = ['password' => Hash::make($request->get('password'))];

                $msg = 'Password successfully changed.';
                
            }
            else{
                $msg = 'Invalid current password entered!';
            }
        }       
         else
        {
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            //return dd($request->all());
            //$request->image->move(public_path('images'), $imageName);
            if($request->get('image')){
                $msg = "Image exists";
            }
            else{
                $msg = $request->image;
            }           
        }     

        $user->update($data);
        return['message' => $msg];
       
    }

    public function picUpload(Request $request) 
    {
        $data = request()->validate([
            'image' => 'sometimes|file|image|max:5000',
        ]); 
                

       // $msg ='Profile Image uploaded successfully.';
        
      //  $user->update($data);
      //  $this->storeImage();
         
        $msg = $request->get('id');

        return['message' => $msg];

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    private function storeImage()
    {
        if(request()->has('image')){
            auth()->user()->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);

            $image = Image::make(('storage/'. auth()->user()->image))->fit(300, 300);

            $image->save();
        }
    } 
}
