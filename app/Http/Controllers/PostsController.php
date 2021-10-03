<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Validation\ValidationException;

use App\Http\Resources\PostResource;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' =>'required|string|max:255',
                'description' =>'required|string|max:255',
                'content' =>'required|string',
                'tags' =>'required'
            ]);

            $slug = preg_replace('/[^A-Za-z0-9-]+/','-',$request->title);
            $slug = strtolower($slug);

            $likes=0;
            $image_url='https://pixabay.com/images/id-6626792/';

            $post = new Post;
            $post -> user_id=2;
            $post -> title=$request->title;

            $post -> slug=$slug;
            $post -> description=$request->description;
            $post -> content=$request->content;
            $post->likes=$likes;
            $post->img_url=$image_url;

            $post->save();


            // Save tags
            $tags = explode(",", $request->tags);


            // dd($tags);
            $post ->tags()->attach($tags);

            // Return response
            return response()->json([
                'Message' =>'Ok',
                'Post'=>new PostResource($post)
            ]);



        } catch (ValidationException $error) {
            return response()->json(
                $error->validator->errors()
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return new PostResource(Post::findOrFail($post->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        try {
            $this->validate($request, [
                'title' =>'required|string|max:255',
                'description' =>'required|string|max:255',
                'content' =>'required|string',
                'tags' =>'required'
            ]);

            $slug = preg_replace('/[^A-Za-z0-9-]+/','-',$request->title);
            $slug = strtolower($slug);

            $likes=0;
            $image_url='https://pixabay.com/images/id-6626792/';

            $post = new Post;
            $post -> user_id=2;
            $post -> title=$request->title;

            $post -> slug=$slug;
            $post -> description=$request->description;
            $post -> content=$request->content;
            $post->likes=$request->likes;
            $post->img_url=$request->img_url;

            $post->save();


            // Save tags
            $tags = explode(",", $request->tags);


            // dd($tags);
            $post ->tags()->sync($tags);

            // Return response
            return response()->json([
                'Message' =>'Ok',
                'Post'=>new PostResource($post)

            ]);



        } catch (ValidationException $error) {
            return response()->json(
                $error->validator->errors()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        // Return response
        return response()->json([
            'Message' => 'ok',
            'Post'=>new PostResource($post)

        ]);
    }
}
