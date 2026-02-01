<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('role:1', ['only' => ['create']]);
    }

    protected function profile()
    {
        $data['user'] = User::findOrFail(auth()->id());
        return view('auth.profile', $data);
    }

    protected function update_profile(Request $request)
    {
        $request->validate([
            'password' => 'required|between:8,30|confirmed',
        ]);

        $user = User::findOrFail(auth()->id());
        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
            return redirect()->back()->with('success_update', 'رمز شما موفقانه تغییر نمود');
        } else {
            return redirect()->back()->with('wrong_pwd', 'رمز قبلی اشتباه است');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function update(Request $request)
    {
        $update = User::findOrFail($request->data_id);
        if (($request->password != '') && ($request->password_confirmation != '') && ($request->password == $request->password_confirmation))
            $update->password = Hash::make($request->password);

        $update->name = $request->name;
        $update->role_id = $request->role_id;
        $update->save();

        return redirect()->back()->with('success_update', 'مشخصات کاربر تغییر نمود');
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
