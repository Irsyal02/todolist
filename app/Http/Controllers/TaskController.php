<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('tasks'));
    }

    public function toggle(Task $task)
    {
        $task->is_completed = !$task->is_completed;
        $task->save();

        return redirect()->back()->with('success', 'Status tugas diperbarui.');
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
            'title' => 'required|string|max:255',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('tasks.index')->with('success', 'Task created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->title = $request->title;
        $task->save();

        return redirect()->back()->with('success', 'Tugas berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return redirect()->back()->with('success', 'Tugas berhasil dihapus.');
    }

}
