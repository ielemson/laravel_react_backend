<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filter=null)
    {
        // if($filter != null){

        // if($filter == "completed"){

        //          return Todo::where([['user_id','=',request()->user()->id],['completed','=',1]])->orderBy('id','desc')->get();
        // }else if($filter == 'uncompleted'){
        //         return Todo::where([['user_id','=',request()->user()->id],['completed','=',0]])->orderBy('id','desc')->get();
        // }else{
        //         return Todo::where('user_id',request()->user()->id)->orderBy('id','desc')->get();

        // }

        // }else{
        //     return Todo::where('user_id',request()->user()->id)->orderBy('id','desc')->get();
        // }

        return Todo::where('user_id',request()->user()->id)->orderBy('id','desc')->get();

    }

    public function all_todos(){
        return Todo::all();
    }
    public function store(Request $request)
    {
        $request->validate([
            'todo'=>'required'
        ]);

        $todo = new Todo;
        $todo->user_id = request()->user()->id;
        $todo->todo = $request->todo;
        $todo->save();
        return response()->json(['status'=>true,'todo'=>$todo],201);
    }

 
    public function update(Request $request)
    {
        $request->validate([
            'todo'=>'required'
        ]);

        $todo = Todo::where('id',$request->id)->first();
        $todo->todo = $request->todo;
      
        $todo->save();
        return response()->json(['status'=>true],201);
    }

    public function complete($id){
        
        $todo = Todo::where('id',$id)->first();
        $todo->completed = true;
        $todo->save();
        return response()->json(['status'=>true],201);
    }

    public function undo($id){
        
        $todo = Todo::where('id',$id)->first();
        $todo->completed = false;
        $todo->save();
        return response()->json(['status'=>true],201);
    }
    
    public function destroy($id)
    {
     Todo::where('id',$id)->delete();
     return response()->json(['status'=>true]);   
    }
}
