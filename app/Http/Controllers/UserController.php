<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function getProfile($id)
    {
        $profile = User::findOrFail($id)->profile;

        return response()->json($profile, 200);
    }

    public function getUserTasks($id)
    {
        $tasks = User::findOrFail($id)->tasks;

        return response()->json($tasks, 200);
    }
}
