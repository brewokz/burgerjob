<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('pages.user.user', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation unique|nama table
        $validateData = $request->validate([
            'fullname' => 'required',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|unique:users|email:dns',
            'is_admin' => 'required',
            'sex' => 'required',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'required',
            'password' => ['required', 'confirmed', Password::min(6)]
            // 'password_confirmation' => 'required',
        ]);
        $encrypt = Hash::make($request->password);
        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'is_admin' => $request->is_admin,
            'sex' => $request->sex,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => $encrypt,
            'profile_picture' => 'unknown.png'
        ]);
        return redirect('user')->with('create', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (auth()->user()->id == $user->id) {
            return view('pages.profile.profile', compact('user'));
        } else {
            return redirect('/user/' . Auth()->User()->id)->with('error', 'You are not authorized to access this page!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'fullname' => 'required',
            'is_admin' => 'required'
        ]);
        User::where('id', $user->id)
            ->update([
                'fullname' => $request->fullname,
                'is_admin' => $request->is_admin
            ]);
        return redirect('user')->with('change', 'User Updated successfully!');
    }
    public function profileEdit(User $user)
    {
        if (auth()->user()->id == $user->id) {
            return view('pages.profile.edit', compact('user'));
        } else {
            return redirect('/user/' . Auth()->User()->id)->with('error', 'You are not authorized to access this page!');
        }
    }

    public function profilePhoto(Request $request, User $user)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $imageName = time() . '_profile.' . $request->photo->extension();
        $request->photo->move(public_path('profile-picture'), $imageName);
        $user->update([
            'profile_picture' => $imageName
        ]);
        // User::where('id', $user->id)
        //     ->update([
        //         'profile_picture' => $imageName
        //     ]);
        return redirect('user/' . Auth()->User()->id)->with('change', 'User profile updated successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request, User $user)
    {
        if (auth()->user()->id == $user->id) {
            $request->validate([
                'fullname' => 'required',
                'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
                'email' => ['required', 'email:dns', Rule::unique('users', 'email')->ignore($user->id)],
                'sex' => 'required',
                'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'address' => 'required',
            ]);
            User::where('id', $user->id)
                ->update([
                    'fullname' => $request->fullname,
                    'username' => $request->username,
                    'email' => $request->email,
                    'sex' => $request->sex,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                ]);
            return redirect('user/' . Auth()->User()->id)->with('change', 'User Updated successfully!');
        } else {
            return redirect('/user/' . Auth()->User()->id)->with('error', 'You are not authorized to access this page!');
        }
    }

    //change password on profile
    public function profileViewChangePassword(User $user)
    {
        if (auth()->user()->id == $user->id) {
            return view('pages.profile.changePassword', compact('user'));
        } else {
            return redirect('/user/' . Auth()->User()->id)->with('error', 'You are not authorized to access this page!');
        }
    }
    public function profileChangePassword(Request $request, User $user)
    {
        if (auth()->user()->id == $user->id) {
            $validateData = $request->validate([
                'password' => ['required', 'confirmed', Password::min(6)]
            ]);
            $encrypt = Hash::make($request->password);
            User::where('id', $user->id)
                ->update([
                    'password' => $encrypt,
                ]);
            return redirect('/user/' . Auth()->User()->id)->with('change', 'Password Updated successfully!');
        } else {
            return redirect('/user/' . Auth()->User()->id)->with('error', 'You are not authorized to access this page!');
        }
    }

    //change password from admin
    public function view_change_password(User $user)
    {
        return view('pages.user.changePassword', compact('user'));
    }
    public function change_password(Request $request, User $user)
    {
        $validateData = $request->validate([
            'password' => ['required', 'confirmed', Password::min(6)]
        ]);
        $encrypt = Hash::make($request->password);
        User::where('id', $user->id)
            ->update([
                'password' => $encrypt,
            ]);
        return redirect('user')->with('change', 'Password Updated successfully!');
    }

    //change own password
    public function editPassword(User $user)
    {
        if (auth()->user()->id == $user->id) {
            return view('auth.changePassword');
        } else {
            return redirect('/user/' . Auth()->User()->id . '/edit-password')->with('error', 'You are not authorized to access this page!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        if (auth()->user()->id == $user->id) {
            $request->validate([
                'password' => ['required', 'confirmed', Password::min(6)]
            ]);
            $encrypt = Hash::make($request->password);
            User::where('id', $user->id)
                ->update([
                    'is_change_password' => true,
                    'password' => $encrypt
                ]);
            return redirect('home');
        } else {
            return redirect('/user/' . Auth()->User()->id . '/edit-password')->with('error', 'You are not authorized to access this page!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            User::destroy($user->id);
            return redirect('user')->with('delete', 'User deleted successfully!');
        } catch (Throwable $e) {
            report($e);
            return redirect('user')->with('delete', 'User can not be deleted!');
            //return false;
        }
    }
}
