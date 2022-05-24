<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function addService(Request $request)
    {
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->min_price = $request->min_price;
        $task->max_price = $request->max_price;
        $task->img = "";
        $id = User::where("remember_token", $request->token)->get()->first()->id;
        $task->executor = $id;
        $task->tags = "";
        $task->customer = $request->user()->currentAccessToken()->id;

        $task->save();
        return response("created", 201);
    }

    public function getUserServices(Request $request)
    {
        $id = $request->user()->currentAccessToken()->tokenable_id;
        $tasks = Task::where("customer", $id)->get();
        return json_encode($tasks);
    }

    public function allServices(Request $request)
    {
        return json_encode(Task::all());
    }
}
