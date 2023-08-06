<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{

    public function index(Request $request): View
    {
        return view('tasks.index', [
            'tasks' => Task::whereBelongsTo($request->user())->get(),
        ]);
    }

    
    public function create()
    {}
   
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->titleValidation($request);
        $request->user()->task()->create($validated);
        return redirect(route('tasks.index'));
    }

    
    public function show(Task $task)
    {}

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);
        
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $this->titleValidation($request);
        $task->update($validated);
        return redirect(route('tasks.index'));

    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect(route('tasks.index'));
    }

    private function titleValidation(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:70',
        ]);
    }
}