<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            return view('user.admin.admin');
        }
        return view('auth.login');
    }

    public function fetchdata():\Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $data = User::query()->where('role','!=','0')->get();
            return response()->json([
                "data" => $data,
            ]);
        }
    }

    public function create(Request $request):int
    {
        if (Auth::check()) {
            $check = User::query()->where('email','=', $request->email)->first();
            if (!$check){
                $user = new User();
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->role = $request->role;
                $user->password = bcrypt($request->password);
                $user->save();
                return 0;
            } else{
                return 1;
            }
        }
    }

    public function edit(int $id):\Illuminate\Http\JsonResponse
    {
        $data = User::query()->whereId($id)->first();
        return response()->json($data);
    }

    public function update(Request $request, int $id)
    {
        $user = User::query()->whereId($id)->first();
        $user->role = $request->role;
        $user->save();
    }
    public function destroy(int $id)
    {
        User::query()->whereId($id)->delete();
    }
}
