<?php

namespace App\Http\Controllers;

use App\Models\Tasklist;
use Illuminate\Http\Request;

class TasklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'new_task'=>'required|max:255',
            'details'=>'required',   
        ]);

        // create a ORM (object relational mapping model) elequent query builder in laravel

        $data = array(
            "taskname"=>$request->new_task,
            "details"=>$request->details 
        );

        // create a ORM query builder for insert data

        Tasklist::create($data); //insert ORM query builder

        //pass a message in laravel using flash session data message

        return redirect('/')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasklist $tasklist)
    {
        $data=Tasklist::all(); // select * from tablename;
        return view('welcome',["data"=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,Tasklist $tasklist)
    {
        $tasklist = Tasklist::find($id);
        return view('edittask')->with('tasklist', $tasklist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasklist $tasklist, $id)
    {
        $task = Tasklist::findOrFail($id);
        $task->update($request->all());

        return redirect('/')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasklist $tasklist, $id)
    {
        Tasklist::where('id',$id)->delete(); //delete from tablename where id='$id';
        
        return redirect('/')->with('del','Task deleted successfully');
    }
}
