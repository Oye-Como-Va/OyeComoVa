<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('modificarusuario', compact('user'));
    }

    public function update(UpdateUserRequest $request, UpdateUserProfileInformation $updater)
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        $updater->update($user, $request->all());

        return redirect()->back()->with('success', 'User profile updated successfully!');
    }
}
