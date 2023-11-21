<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $id =auth()->id() ;

        $user = User::find($id);
        return view('user.profile', compact('user'));
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_image')) {
            $profile_data = $request->file('profile_image');
            $profile_name= time() . $profile_data->getClientOriginalName() ;
            $location= public_path('./profile_images') ;
            $profile_data ->move($location,$profile_name);
            $user->profile=$profile_name;

            $user->save();
        }

        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }

}
