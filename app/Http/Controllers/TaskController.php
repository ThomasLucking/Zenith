<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('welcome', compact('tasks'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create($validated + ['is_completed' => false]);

        return redirect('/');
    }

    public function update(Task $task): RedirectResponse
    {
 
        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        return back(); 
    }
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return back();
    }
}