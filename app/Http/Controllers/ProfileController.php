<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function show($id)
    {
        $profile = Profile::where('user_id', $id)->firstOrFail();

        return response()->json($profile, 200);
    }

    public function store(StoreProfileRequest $request)
    {
        $userId = Auth::user()->id;
        $validated = $request->validated();
        $validated['user_id'] = $userId;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profile', 'public');
            $validated['image'] = $path;
        }
        $profile = Profile::create($validated);

        return response()->json([
            'message' => 'Profile created successfully.',
            'profile' => $profile,
        ], 201);
    }

    public function update(UpdateProfileRequest $request, $id)
    {
        $profile = Profile::where('user_id', $id)->firstOrFail();
        $profile->update($request->validated());

        return response()->json([
            'message' => 'Profile updated successfully.',
            'profile' => $profile,
        ], 200);
    }
}
