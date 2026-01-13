<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // List all tasks for the logged-in user
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->get(); 
        return response()->json($tasks);
    }

    // Create a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = $request->user()->tasks()->create($request->all());
        return response()->json($task, 201);
    }

    // Show a single task
    public function show($id, Request $request)
    {
        $task = $request->user()->tasks()->find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json($task);
    }

    // Update a task
    public function update(Request $request, $id)
    {
        $task = $request->user()->tasks()->find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task->update($request->all());
        return response()->json($task);
    }

    // Delete a task
    public function destroy(Request $request, $id)
    {
        $task = $request->user()->tasks()->find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
