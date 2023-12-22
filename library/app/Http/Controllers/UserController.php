<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            return response()->json($user);
        }
        return response()->json([
            "error" => "User not found"
        ], 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], 400);
        }
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            "message" => "Profile creation was successfull"
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'unique:users',
            'email' => 'email|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], 400);
        }
        $user = User::find($id);
        $user->email =  is_null($request->email) ? $user->email : $request->email;
        $user->name = is_null($request->name) ? $user->name : $request->name;
        $user->password = is_null($request->password) ? $user->password : bcrypt($request->password);
        $user->updated_at = Carbon::now();
        $user->save();
        return response()->json([
            "message" => "Profile update was successfull"
        ], 200);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return response()->json([
                "error" => "User not found"
            ], 404);
        }
        $user->delete();
        return response()->json([
            "message" => "User deleted successfully"
        ], 200);
    }
    public function index()
    {
        $users = User::all();
        return response()->json([
            "message" => $users
        ], 200);
    }
}
