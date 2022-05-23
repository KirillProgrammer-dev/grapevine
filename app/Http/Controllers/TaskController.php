<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TasksController extends Controller
{

    public function addServices(Request $request){
        $task = new Task;
        $task->title = $request->title;
        $task->describtion = $request->describtion;
        $task->deadline = $request->deadline;
        $task->min_price = $request->min_price;
        $task->max_price = $request->max_price;
        $task->img = "";
        $id = User::where("remember_token", $request->user()->currentAccessToken())->get()->first()->id;
        $task->executer = $id;
        $task->customer = "";

        $task->save();
        return response("created", 201);
    }
    
}
