<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
   public function edit(){
   	 return view('profile.edit');
   }

   public function update(Request $request){
	    $this->validate($request,[
            'name' => 'string|max:255',
            'birthday' => 'string',
            'phone' => 'string|max:255',           
            'email' => 'string|email|max:255',
        ]);

      if (isset($request->password)){
        $this->validate($request,[
        'password' => 'string|confirmed|min:8',
        ]);
        $user->password=bcrypt($request->password);
      }

        $user=User::find(Auth::id());

        if($request->hasFile('image')){
          $image=$request->image;
          $image_new_name=time().$image->getClientOriginalName();
          $image->move('uploads/avatars',$image_new_name);
          $user->image='uploads/avatars/'.$image_new_name;
        }
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->birthday=$request->birthday;
        $user->gender=$request->gender;
        $user->email=$request->email;
        $user->save();
        session()->flash('success', 'Profile updated successfully.');
        return redirect()->route('dashboard');
   }

   public function block($id){
     $user=User::find($id);
     $user->blocked=1;
     $user->save();
     session()->flash('success', 'user blocked successfully.');
     return redirect()->route('users');
   }

   public function unblock($id){
     $user=User::find($id);
     $user->blocked=0;
     $user->save();
     session()->flash('success', 'user unblocked successfully.');
     return redirect()->route('users');
   }

    public function adminadd(){
      return view('users.admincreate');
    }
    public function admin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'admin' =>1,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', 'Admin created successfully.');
        return redirect()->route('users');
    }   

    public function adminremove($id){
      $user=User::find($id);
      $user->admin=0;
      $user->save();
      session()->flash('success', 'Admin Removed successfully.');
      return redirect()->route('users');
    }
}
