<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        $user = $user = User::findOrFail(Auth::id());

        return view('modificarusuario', compact('user'));
    }

   // public function update(UpdateUserRequest $request, UpdateUserProfileInformation $updater)
   // {
      //  $user = \Illuminate\Support\Facades\Auth::user();

     //  $updater->update($user, $request->all());

      //  return redirect()->back()->with('success', 'User profile updated successfully!');
  //  }
}
