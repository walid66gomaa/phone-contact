<?php

namespace App\Http\Controllers;

use App\PhoneBook;
use Illuminate\Http\Request;
use App\image;
use App\Http\Requests\phoneBookRequest;
use Illuminate\Support\Facades\Auth;
class PhoneBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     * 
     */


     function upload(Request $request)
     {
            //  if($request->hasFile('image'))
            //  {   
            //      $imagname=$request->image->getClientOriginalName();
            //      echo $imagname;
                  
            //     $path = $request->image->storeAs('public', $imagname);
            //     // $request->image->store('public/walid');
               
            //  }
            //  else{}
            // return false;
              $image=new image();
             
             // $image->url=substr($request->image,0,162110);;
             $image->url=$request->image;
            $image->test= 'ddddd';
            
           $image->save();
           echo $request->image;
           return response(null,200);
     }
    public function index()
    {
        //
       
        return view('phoneBook');
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
    public function store(PhoneBookRequest $request)
    {
       
        $phonebook=new PhoneBook();
        $phonebook->name=$request->name;
      
        $phonebook->email=$request->email;
        $phonebook->phone=$request->phone;
       // $phonebook->userid=Auth::user()->id;

       $phonebook->userid=4;

       if(strlen($request->image)>0)
       {
        $phonebook->url=    $request->image;
       }


      
  
    

       
      

        $phonebook->save();
    
    
     return $phonebook;
    
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PhoneBook  $phoneBook
     * @return \Illuminate\Http\Response
     */
    public function show(PhoneBook $phoneBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PhoneBook  $phoneBook
     * @return \Illuminate\Http\Response
     */
    public function edit(PhoneBook $phoneBook)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PhoneBook  $phoneBook
     * @return \Illuminate\Http\Response
     */
    public function update(phoneBookRequest $request)
    {
        //

        $phonebook= PhoneBook::find($request->id);
      
        $phonebook->name=$request->name;
        $phonebook->email=$request->email;
        $phonebook->phone=$request->phone;
        $phonebook->save();
    
    
     //return  $request::all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PhoneBook  $phoneBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhoneBook $phoneBook)
    {
        PhoneBook::where('id',$phoneBook->id)->delete();
    }

    public function getdata()
    {
        return phoneBook::orderBy('name')->get();
    }


    
}
