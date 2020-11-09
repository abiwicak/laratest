<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Post;
use App\User;

class PostController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = Auth::user();

        return view('post.create',['auth' => $auth]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
        ]);

        Post::create([
            "title" => $request->title,
            "text" => $request->text,
            "user_id" => $request->user_id,
        ]);

        return redirect('/post')->with('status','Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $user = $post->user;
        
        if (Gate::any(['admin','editor','self'], $user)) {
            return view('post.edit', ['post' => $post]);
        }
            return redirect('/post')->with('error','You do not have access this post!');
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        $user = $post->user;
        if (Gate::any(['admin','editor','self'], $user)) {
            $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'text' => ['required', 'string'],
            ]);

            $post->update([
                "title" => $request->title,
                "text" => $request->text
            ]);

            return redirect('/post')->with('status','Post updated successfully!');
        }
        return redirect('/post')->with('error','You do not have access this post!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $user = $post->user;
        if (Gate::any(['admin','editor','self'], $user)) {
            $post->delete();
            return redirect('/post')->with('status','Post deleted successfully!');
        }
        return redirect('/post')->with('error','You do not have access this post!');
        

    }
}
