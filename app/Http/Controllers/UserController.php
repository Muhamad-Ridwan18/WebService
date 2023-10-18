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
        $users = User::all();
        return response()->json($users);
    }
    

    public function update($id){
        return "Tampilan update pengguna dengan ID: $id";
    }

    public function destroy($id){
        return "Tampilan delete pengguna dengan ID: $id";
    }

}
