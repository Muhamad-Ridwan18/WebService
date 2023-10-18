<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(5);
        return response()->json([
            'message' => 'Success', 
            'data' => $posts
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json(['message' => 'Success', 'data' => $post]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error', 'errors' => $validator->errors()], 400);
        }

        $post = Post::create($request->all());
        return response()->json(['message' => 'Post created successfully', 'data' => $post], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ]);
    
        if ($validator->fails()) {
    
            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);
    
        } else {
    
            $post = Post::whereId($id)->update([
                'title'     => $request->input('title'),
                'content'   => $request->input('content'),
            ]);
    
            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Diupdate!',
                    'data' => $post
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
        $post = Post::whereId($id)->first();
		
        $post->delete();

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Dihapus!',
                ], 200);
            }
    }
}

