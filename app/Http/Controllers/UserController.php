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
    

    public function update($id){
        return "Tampilan update pengguna dengan ID: $id";
    }

    public function destroy($id){
        return "Tampilan delete pengguna dengan ID: $id";
    }

}
