<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthday' => 'required|string',
            'phone' => 'required|string|max:255',
            'gender' => 'required',
            'image'=>'required|image',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
      $image=$request->image;
      $image_new_name=time().$image->getClientOriginalName();
      $image->move('uploads/avatars',$image_new_name);
        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'image' => 'uploads/avatars/'.$image_new_name,
            'password' => bcrypt($request->password),
        ]));

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
