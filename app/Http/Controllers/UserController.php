<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = User::all();
        return ['data' => $user];
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return ['data' => $user];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 403);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->number = $request->number;
        $user->user_type = $request->user_type;

        $user->save();
        return response()->json([
            "status" => true,
            "message" => "Data User berhasil disimpan..",
            "data" => $user
        ]);
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return ['users' => $user];
    }
}
