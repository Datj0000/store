<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('user.admin.admin');
        }
        return Redirect::to('/login');
    }

    public function fetchdata()
    {
        if (Auth::check()) {
            $query = User::query()->where('role','!=',0)->get();
            if($query){
                return response()->json([
                    "data" => $query->toArray(),
                ]);
            }
        }
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            $check = User::query()->where('email','=',$request->input('email'))->first();
            if (!$check){
                User::query()->create([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'role' => $request->input('role'),
                    'password' => bcrypt($request->input('password')),
                ]);
                return 0;
            } else{
                return 1;
            }
        }
    }

    public function edit(int $id)
    {
        $query = User::query()->where('id','=',$id)->first();
        if ($query) {
            return response()->json($query->toArray());
        }
    }

    public function update(Request $request,int $id)
    {
        $query = User::query()->where('id','=',$id)->first();
        $query?->update(['role' => $request->input('role')]);
    }
    public function destroy(int $id)
    {
        $query = User::query()->where('id','=',$id)->first();
        $query?->delete();
    }
}
