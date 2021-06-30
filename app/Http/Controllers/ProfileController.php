<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{

    public function index()
    {
        if (view()->exists('pages.profile.index'))
        {
            return view('pages.profile.index');
        }
        return abort(404);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required'],
            'email' => ['required','unique:users,email,'.$id],
        ]);
        $response = $user->update($request->all());
        if($response)
        {
            return  redirect()->route('profile.index')->withSuccess('Profile saved successfully!');
        }
        return  redirect()->route('profile.index')->withError("Something wen't wrong!");
    }

    public function changePasswordForm()
    {
        if (view()->exists('pages.profile.changePassword')) 
        {
            return view('pages.profile.changePassword');
        }
        return abort(404);   
    }

    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $HashPassword = bcrypt($request->input('password'));
        $all = [
            'password' => $HashPassword
        ];
        $response = $user->update($all);
        
        if($response)
        {
            return  redirect()->route('profile.index')->withSuccess('Password changed successfully!');
        }
        return  redirect()->route('profile.index')->withError("Something wen't wrong!");
    }

    public function generateApiKey()
    {
        $user = Auth::user();
        $token = $user->createToken('Token for user account '.$user->name)->plainTextToken;
        Log::info('Your API token is '. $token);
        return  redirect()->route('profile.index')->withApi('Your API Token Key has been generated. \n ' . $token);
    }

    public function deleteApiKey()
    {
        $token = auth()->user()->tokens()->delete();
        Log::info('Your API token deleted - '. $token);
        return  redirect()->route('profile.index')->withInfo('Your API Token Key has been deleted successfully.');
    }
}
