<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Visitors;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
    

        public function index(){
           
            return Visitors::all();
            // return response()->json(['visitors'=>Visitors::all()]);
        }

    public function store(Request $request){

        $visitors_check = Visitors::where('ipv4',$request->ipv4)->first();

        if(!$visitors_check){

             // return $request;
        $visitors = new Visitors();
        $visitors->ipv4 = $request->ipv4;
        $visitors->city = $request->city;
        $visitors->country_code = $request->country_code;
        $visitors->country_name = $request->country_name;
        $visitors->latitude = $request->latitude;
        $visitors->longitude = $request->longitude;
        $visitors->state = $request->state;

        $visitors->save();

        return response()->json([
            'visitors'=>$visitors
        ],200);
        }
       
    }
}
