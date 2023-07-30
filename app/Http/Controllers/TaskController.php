<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
// use App\Repositories\TaskRepository;

class TaskController extends Controller
{

    public function gettasks()
    {
        // dd('hello');
        $response= [
            'status'=>1,
            'status_code'=>201,
            'tasks'=>Task::all(),
        ];     

        return response()->json(['response'=>$response]);       
    }
    

    public function task($id)
    {
        $task = Task::find($id);
        if($task){

            $response= [
                'status'=>1,
                'status_code'=>200,
                'response'=>[
                    'task'=>$task,
                ]
            ];
            return response()->json($response);     
        }else{
            return response()->json([
                'status'=>0,
                'status_code'=>404,
                'message'=>'page not found'
            ]);
        }
    }


    public function create(Request $req)
    {
        $attributes = [
            'title'=>$req->title,
            'description'=>$req->description,
            'completed'=>FALSE

        ];
           
        
        $task=Task::create($attributes);
        return response()->json(['status'=>1,
                                'status_code'=>201,
                                'message'=>'task created successfully', 
                                'task'=>$task]);
    }


    public function update(Request $request,$id)
    {
        $task =  Task::find($id);
        $task->title=$request->title;
        $task->description=$request->description;
        $result = $task->save();
        
        if($result)
        {
            return response()->json(['status'=>1,
                                    'status_code'=>200,
                                    'message'=>'task updated successfully', 
                                    'task'=>$task]);

        }else{
            return response()->json(['status'=>0,
                                    'status_code'=>404,
                                    'message'=>'page not found']);
        }
    }


    public function toggleComplete($id)
    {  
        $task = Task::find($id);

        if($task)
        {
            if($task->completed==TRUE)
            {
                $task->completed=FALSE;
            }else{
                $task->completed=TRUE;
            }
            $task->save();
            return response()->json(['status'=>1,
                                    'status_code'=>200,
                                    'message'=>'task toggled',
                                    'task'=>$task]); 
        }else{
            return response()->json(['status'=>0,
                                    'status_code'=>404,
                                    'message'=>'not found']); 
        }
    }


    public function delete(Request $request,$id){
        $task = Task::find($id);
        
        if($task)
        {
            $task->delete();
            return response()->json(['message'=>'task removed successfully','200']);
        }else{
            return response()->json(['message'=>'task not found ','404']);
        }
       
    }
        
    

    
}
