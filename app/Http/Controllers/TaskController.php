<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = auth()->user()->tasks()->orderBy('created_at', 'desc')->get();
        return view('index', compact('tasks'));
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
    public function store(Request $request) {
    $request->validate(['title' => 'required']);

    auth()->user()->tasks()->create([
        'title' => $request->title,
        'completed' => false
    ]);

    return redirect('/');
}

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Task $task)
    {
        $task->completed = !$task -> completed;
        $task->save();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/');
    }

public function complete(Task $task)
{
    $task->update([
        'completed' => true,
    ]);

    return redirect()->route('home')->with('success', 'Task marked as completed!');
}

    public function pending() {
    $tasks = auth()->user()->tasks()->where('completed', false)->get();
    return view('tasks.index', compact('tasks'));
}

}
