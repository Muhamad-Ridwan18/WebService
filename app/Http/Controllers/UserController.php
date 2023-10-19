<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    function getStatus()
    {
        return response()->json([
            'service name' => 'PHP Running Serve',
            'status' => 'Running'
        ]);
    }
    
    public function index(){
        $users = User::orderBy('name', 'DESC')->paginate(10);
        return response()->json([
            'success' => true,
            'message' =>'List Semua User',
            'data'    => $users
        ], 200);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
            'phone_number' => 'required',
            'alamat' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error', 'errors' => $validator->errors()], 400);
        }

        $user = User::create($request->all());
        return response()->json(['message' => 'User created successfully', 'data' => $user], 201);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
            'phone_number' => 'required',
            'alamat' => 'required',
            'image' => 'required',
        ]);
    
        if ($validator->fails()) {
    
            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);
    
        } else {
    
            $user = User::whereId($id)->update([
                'name'     => $request->input('name'),
                'email'   => $request->input('email'),
                'role'   => $request->input('role'),
                'password'   => $request->input('password'),
                'phone_number'   => $request->input('phone_number'),
                'alamat'   => $request->input('alamat'),
                'image'   => $request->input('image'),
            ]);
    
            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Berhasil Diupdate!',
                    'data' => $user
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Diupdate!',
                ], 400);
            }
    
        }
    }

    public function destroy($id)
    {
        $user = User::whereId($id)->first();
		
        $user->delete();

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Berhasil Dihapus!',
                ], 200);
            }
    }

}
