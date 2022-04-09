<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return view('layout.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return 1;
        } else{
            return 0;
        }
    }
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
    public function change_pass()
    {
        if (Auth::check()) {
            return view('auth.changepass');
        }
    }
    public function change_new_pass(Request $request)
    {
        if (Auth::check()) {
            $id = Auth::id();
            $user = User::query()->whereId($id)->first();
            if ($user->password == bcrypt($request->old_password)) {
                $user->password = bcrypt($request->password);
                $user->save();
                return 1;
            } else {
                return 0;
            }
        }
    }
    public function profile()
    {
        if (Auth::check()) {
            return view('auth.profile');
        }
    }

    public function update_profile(Request $request)
    {
        if (Auth::check()) {
            $id = Auth::id();
            User::query()->whereId($id)->update([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
            ]);
            $get_image = $request->file('image');
            $check_email = User::query()->where('email','=', $request->email)->where('id', '!=', $id)->first();
            if ($check_email) {
                return 0;
            } else {
                if ($get_image) {
                    if ($user->image) {
                        $destinationPath = 'uploads/avatar/' . $user->image;
                        if (file_exists($destinationPath)) {
                            unlink($destinationPath);
                        }
                    }
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move('uploads/avatar', $new_image);
                    User::query()->whereId($id)->update([
                        'image' => $new_image,
                    ]);
                }
                return 1;
            }
        }
    }
    //Resetpass
    public function recover(Request $request):int
    {
        if (!Auth::check()) {
            $user = User::query()->where('email','=', $request->email)->first();
            if ($user) {
                return 1;
            } else {
                return 0;
            }
        }
    }
    public function send_token(Request $request)
    {
        if (!Auth::check()) {
            $title_mail = "Reset password";
            // $user = User::query()->where('email','=', $request->email)->first();
            $user = User::query()->where('email','=', $request->email)->update([
                'token' => Str::random(),
            ]);
            if ($user) {
                $data = array("name" => $title_mail, "body" => $user->token, 'email' => $user->email); //body of mail.blade.php
                Mail::send('mail.emailforgotpass', ['data' => $data], function ($message) use ($title_mail, $data) {
                    $message->to($data['email'])->subject($title_mail); //send this mail with subject
                    $message->from($data['email'], $title_mail); //send from this mail
                });
            }
        }
    }
    public function reset_pass(Request $request):int
    {
        if (!Auth::check()) {
            $user = User::query()->where('email','=', $request->email)->where('token','=', $request->token)->first();
            if ($user) {
                $user->password = bcrypt($request->password);
                $user->token = Str::random();
                $user->save();
                return 1;
            } else {
                return 0;
            }
        }
    }
}
