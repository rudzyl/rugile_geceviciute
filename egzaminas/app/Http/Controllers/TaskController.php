<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Status;
use Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $statuses = Status::all();
        if ($request->status_id) {
         $tasks = Task::where('status_id',$request->status_id)->get();
         $filterBy = $request->status_id;
     }
     else {
      $tasks = Task::orderBy('add_date', 'desc')->get();
     }
        
       return view('task.index', ['tasks' => $tasks, 'statuses' => $statuses, 'filterBy'=> $filterBy ?? 0]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $statuses = Status::all();
       return view('task.create', ['statuses' => $statuses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(),
       [
          'task_name' => ['required', 'min:3', 'max:64'],
          'add_date' => ['required', 'min:3', 'max:64'],
          'task_description' => ['required', 'min:3', 'max:64'],
       ],
      [
       'task_name.required' => 'Please enter task name',
       'task_name.min' => 'can not be shorter than 3 symbols',
      ],

      [
       'task_description.required' => 'Please enter description',
       'task_description.min' => 'can not be shorter than 3 symbols'
      ]        
      );
      if ($validator->fails()) {
          $request->flash(); 
          return redirect()->back()->withErrors($validator);
      }
     Task::new()->refreshAndSave($request);
       return redirect()->route('task.index')->with('success_message', 'Task entered.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $statuses = Status::all();
       return view('task.edit', ['task' => $task, 'statuses' => $statuses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
      $validator = Validator::make($request->all(),
      [
         'task_name' => ['required', 'min:3', 'max:64'],
         'add_date' => ['required', 'min:3', 'max:64'],
         'task_description' => ['required', 'min:3', 'max:64'],
      ],
     [
      'task_name.required' => 'Please enter task name',
      'task_name.min' => 'can not be shorter than 3 symbols',
     ],

     [
      'task_description.required' => 'Please enter description',
      'task_description.min' => 'can not be shorter than 3 symbols'
     ]        
     );
     if ($validator->fails()) {
         $request->flash(); 
         return redirect()->back()->withErrors($validator);
     }
      $task->refreshAndSave($request);
       return redirect()->route('task.index')->with('success_message', 'Task edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
       $task->delete();
       return redirect()->route('task.index')->with('success_message', 'Task destroyed.');
    }
}
