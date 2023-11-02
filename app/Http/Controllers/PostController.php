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
        return response()->json(['message' => 'Success', 'data' => $posts]);
    }

    public function show(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            $response = ['message' => 'Post not found'];
            $format = $request->header('Accept');

            if ($format === 'application/xml') {
                $response = $this->arrayToXml($response);
                return response($response, 404)->header('Content-Type', 'application/xml');
            }

            return response()->json($response, 404);
        }

        $response = ['message' => 'Success', 'data' => $post];

        $format = $request->header('Accept');
        if ($format === 'application/xml') {
            $response = $this->arrayToXml($response);
            return response($response, 200)->header('Content-Type', 'application/xml');
        }

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'views' => 'required',
            'published' => 'required',
        ]);

        if ($validator->fails()) {
            $response = ['message' => 'Validation error', 'errors' => $validator->errors()];

            $format = $request->header('Accept');
            if ($format === 'application/xml') {
                $response = $this->arrayToXml($response);
                return response($response, 400)->header('Content-Type', 'application/xml');
            }

            return response()->json($response, 400);
        }

        $post = Post::create($request->all());

        $response = ['message' => 'Post created successfully', 'data' => $post];

        $format = $request->header('Accept');
        if ($format === 'application/xml') {
            $response = $this->arrayToXml($response);
            return response($response, 201)->header('Content-Type', 'application/xml');
        }

        return response()->json($response, 201);
    }

    
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            $response = ['message' => 'Post not found'];
            $format = $request->header('Accept');

            if ($format === 'application/xml') {
                $response = $this->arrayToXml($response);
                return response($response, 404)->header('Content-Type', 'application/xml');
            }

            return response()->json($response, 404);
        }

        // Periksa "Content-Type" header
        $contentType = $request->header('Content-Type');

        if ($contentType === 'application/json') {
            $data = $request->json()->all();
        } elseif ($contentType === 'application/xml') {
            // Mengambil data dalam format XML dan mengonversinya menjadi array
            $xmlData = simplexml_load_string($request->getContent());
            $jsonData = json_encode($xmlData);
            $data = json_decode($jsonData, true);
        } else {
            $response = ['message' => 'Unsupported Content-Type'];
            $format = $request->header('Accept');

            if ($format === 'application/xml') {
                $response = $this->arrayToXml($response);
                return response($response, 400)->header('Content-Type', 'application/xml');
            }

            return response()->json($response, 400);
        }

        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'views' => 'required',
            'published' => 'required',
        ]);

        if ($validator->fails()) {
            $response = ['message' => 'Validation error', 'errors' => $validator->errors()];
            $format = $request->header('Accept');

            if ($format === 'application/xml') {
                $response = $this->arrayToXml($response);
                return response($response, 400)->header('Content-Type', 'application/xml');
            }

            return response()->json($response, 400);
        }

        $post->update($data);

        $response = ['message' => 'Post updated successfully', 'data' => $post];

        $format = $request->header('Accept');

        if ($format === 'application/xml') {
            $response = $this->arrayToXml($response);
            return response($response, 200)->header('Content-Type', 'application/xml');
        }

        return response()->json($response, 200);
    }



    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            $response = ['message' => 'Post not found'];
            $format = $request->header('Accept');

            if ($format === 'application/xml') {
                $response = $this->arrayToXml($response);
                return response($response, 404)->header('Content-Type', 'application/xml');
            }

            return response()->json($response, 404);
        }

        $post->delete();

        $response = ['message' => 'Post deleted successfully'];

        $format = $request->header('Accept');
        if ($format === 'application/xml') {
            $response = $this->arrayToXml($response);
            return response($response, 200)->header('Content-Type', 'application/xml');
        }

        return response()->json($response, 200);
    }

    private function arrayToXml($data, $rootNodeName = 'response', $xml = null)
    {
        if ($xml === null) {
            $xml = new \SimpleXMLElement("<$rootNodeName/>");
        }

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $this->arrayToXml($value, $key, $xml->addChild($key));
            } else {
                $xml->addChild($key, $value);
            }
        }

        return $xml->asXML();
    }
}
