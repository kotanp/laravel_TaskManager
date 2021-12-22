<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks=Task::all();
        return response()->json($tasks);
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
        $task=new Task();
        $task->title=$request->title;
        $task->description=$request->description;
        $task->end_date=$request->end_date;
        $task->userId=$request->userId;
        $task->status=$request->status;

        $task->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($taskId)
    {
        $task=Task::find($taskId);
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $taskId)
    {
        $task=Task::find($taskId);
        $task->title=$request->title;
        $task->description=$request->description;
        $task->end_date=$request->end_date;
        $task->status=$request->status;
        $task->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($taskId)
    {
        $task=Task::find($taskId);
        $task->delete();
    }

    public function sortBy($column, $order)
    {
        //$task=Task::with('user')->get()->sortBy($column)->values()->all();
        $task=Task::with('user')->orderBy($column, $order)->get();
        return response()->json($task);
    }

    public function expand()
    {
        $tasks=Task::with('user')->get();
        //$task=Task::all()->user;
        return $tasks;
    }

    public function search($column, $expression, $value)
    {
        $tasks=Task::with('user')->where($column, $expression, $value)->get();
        return $tasks;
    }
}
