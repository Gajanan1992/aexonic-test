<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        return view('home', compact('users'));
    }

    public function userDetails()
    {
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }
    public function editUser($id)
    {
        $authUser = Auth::user();
        if ($authUser->id != $id) {
            abort(403, 'You have not permission');
        }
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'profile' => 'nullable|image',
            'pin_code' => 'nullable|numeric|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->mobile = $request['mobile'];
        $user->country = $request['country'];
        $user->state = $request['state'];
        $user->pin_code = $request['pin_code'];

        if ($request['password'] !== null) {
            $user->password = Hash::make($request['password']);
        }

        if ($request['profile'] !== null) {
            $img = $request['profile'];
            $filename = $img->getClientOriginalName();
            $imageUrl = Storage::putFileAs('public/images/', $request['profile'], $filename);
            $user->profile = $imageUrl;
        }
        $user->save();
        return redirect()->route('user.details')->with('msg', 'User details updated successfully...');
    }

    public function changeUserStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status =  !$user->status;
        $user->save();

        // Auth::logout($user);
        return redirect()->route('home')->with('msg', 'User account status changed successfully...');
    }
}
