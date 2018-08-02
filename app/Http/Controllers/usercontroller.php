<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class usercontroller extends Controller
{
   public function  imageupload(Request $request){
       $request->user()->url=$request->image;
       $request->user()->save();

       return response(null,200);
    
   }






   
   public function  saveimage(Request $request){

       if($request->hasFile('image'))
             {   
                 $imagname=$request->image->getClientOriginalName();
                 echo $imagname;
                  
                $path = $request->image->storeAs('public/'.auth()->user()->id, $imagname);
                auth()->user()->image=$imagname;
                auth()->user()->save();

                return response(null,$imagname);
               
             }
             else{}
            
     
       return response(null,202);
   }
 
}
