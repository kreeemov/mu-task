<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::where('active', true)->orderBy('id', 'DESC')->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validation = $request->validate([
            'title' => 'required|unique:posts|max:255|min:3',
            'body' => 'required',
        ]);

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return redirect(route('posts.index'))->with('message', 'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        $comments = Comment::where('post_id', $post->id)->orderBy('id', 'DESC')->get();

        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        if($post->user_id == Auth::user()->id){
            return view('posts.edit', compact('post'));
        }else{
            return redirect(route('posts.index'))->with('message', 'You Have no Access to Edit this post');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        if($post->user_id == Auth::user()->id){

            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->save();
            return back()->with('message', 'Post Updated Successfully');

        }else{

            return redirect(route('posts.index'))->with('message', 'You Have no Access to Edit this post');

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        if($post->user_id == Auth::user()->id){

            $post->delete();
            return redirect(route('posts.index'))->with('message', 'Post Deleted Successfully');

        }else{

            return redirect(route('posts.index'))->with('message', 'You Have no Access to Edit this post');

        }

    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response(['msg' => 'Post deleted', 'status' => 'success']);
    }
}
