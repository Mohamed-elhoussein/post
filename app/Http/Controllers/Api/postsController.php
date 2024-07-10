<?php

namespace App\Http\Controllers\Api;

use App\Models\post;
use Illuminate\Http\Request;
use App\Http\Requests\postRequest;
use App\Http\Controllers\Controller;

class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = post::all();
        return response()->json([
            "allData"=>$posts,
            "message"=>"'Products retrieved successfully.",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(postRequest $request)
    {
        $post = post::create($request);
        return response()->json([
            "newPost"=>$post,
            "message"=>"'create a new post successfully.",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = post::find($id);

        if (is_null($post)) {
            return response()->json(["message","Product not found"],401);
        }

        return response()->json(["post",$post],200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->except("_token","method");
        post::findOrfail($id)->update($data);
            return response()->json([
                "message"=>"success update post"
            ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        post::where("id",$id)->delete();

        return response()->json([
            "message"=>"success delete post"
        ],201);
    }
}
