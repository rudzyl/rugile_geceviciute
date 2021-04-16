<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Validator;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
       return view('status.index', ['statuses' => $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('status.create');
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
           'status_name' => ['required', 'min:3', 'max:64'],
       ],
       [
        'status_name.required' => 'Please enter the name',
        'status_name.min' => 'can not be shorter than 3 symbols'
       ]

       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

       Status::new()->refreshAndSave($request);
        return redirect()->route('status.index')->with('success_message', 'Status entered.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        return view('status.edit', ['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $validator = Validator::make($request->all(),
       [
           'status_name' => ['required', 'min:7', 'max:64']
       ],
       [
        'status_name.required' => 'Please enter: uzbaigta, neuzbaigta, atideta',
        'status_name.min' => 'can not be shorter than 7 symbols'
       ]
       );
       if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
        }

        $status->refreshAndSave($request);
       return redirect()->route('status.index')->with('success_message', 'Status edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        
       if($status->statusTask->count()){
        return redirect()->route('status.index')->with('info_message', 'Can not delete, has task to do.');
    }
    $status->delete();
       return redirect()->route('status.index')->with('success_message', 'Status destroyed.');
    }
}
