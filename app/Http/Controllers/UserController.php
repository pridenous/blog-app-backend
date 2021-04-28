<?php

namespace App\Http\Controllers;

// namespace App\Models;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
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
        return response()->json($user);
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

    public function update(Request $request, $id)
    {
        $user = new User;
        $user->findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:191',
            'email' => 'email|max:191|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:6',
        ]);

        if ($validator->fails()) {
            return $request->json([
                'status' => false,
                'message' => $validator->errors()
            ], 403);
        }

        // # Syntaxis/Query Update
        // User::where('id', $id)
        //     ->update([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         // 'password' = Hash::make($request->password),
        //         // 'number' = $request->number,
        //         // 'user_type' = $request->user_type
        //     ]);
        $user->update($request->all());

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Data berhasil di update'
        // ]);

        return ['data' => $user];
    }

    public function delete($id)
    {
    }
}
