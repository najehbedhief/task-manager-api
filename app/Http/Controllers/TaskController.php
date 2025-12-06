<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks;

        return response()->json($tasks, 200);
    }

    public function store(StoreTaskRequest $request)
    {
        $user_id = Auth::user()->id;
        $validatedData = $request->validated();
        $validatedData['user_id'] = $user_id;
        $task = Task::create($validatedData);

        return response()->json($task, 201);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($id);
        if ($task->user_id != $user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->update($request->validated());

        return response()->json($task, 200);
    }

    public function show($id)
    {
        $task = Task::find($id);

        return response()->json($task, 200);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }

    public function getTaskUser($id)
    {
        $user = Task::findOrFail($id)->user;

        return response()->json($user, 200);
    }

    public function addCategoriesToTask(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->categories->attach($request->category_id);

        return response()->json('category attached successfully', 200);

    }

    public function getAllTasks()
    {
        $tasks = Task::all();

        return response()->json($tasks, 200);
    }
}
