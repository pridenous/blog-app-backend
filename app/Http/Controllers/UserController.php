<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user);
    }
}
