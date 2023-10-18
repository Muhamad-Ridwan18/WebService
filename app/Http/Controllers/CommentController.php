<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
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
        $comments = Comment::orderBy('name', 'DESC')->paginate(10);
        return response()->json([
            'success' => true,
            'message' =>'List Semua Comment',
            'data'    => $comments
        ], 200);
    }
}
