<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('pages.user.create', compact('users'));
    }

    public function store(UserStoreRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);

        $response = User::create($validatedData);
        if($response)
        {
            return  redirect()->route('users.index')->withSuccess('User saved successfully!');
        }
        return  redirect()->route('users.index')->withError("Something wen't wrong!");
    }

    public function edit(User $user)
    {
        $users = User::all();
        return view('pages.user.update', compact('users', 'user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);

        $response = $user->update($validatedData);
        if($response)
        {
            return  redirect()->route('users.index')->withSuccess('User updated successfully!');
        }
        return  redirect()->route('users.index')->withError("Something wen't wrong!");
    }

    public function destroy(User $user)
    {
        $response = $user->delete();
        if($response)
        {
            return  redirect()->route('users.index')->withSuccess('User deleted successfully!');
        }
        return  redirect()->route('users.index')->withError("Something wen't wrong!");
    }
}
