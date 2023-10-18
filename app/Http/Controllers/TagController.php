<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index ()
    {
        $tags = Tag::orderBy('name', 'DESC')->paginate(10);
        return response()->json([
            'success' => true,
            'message' =>'List Semua Tag',
            'data'    => $tags
        ], 200);
    }
}
