<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index()
    {
        return view('post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request);
        $user = $request->user();
        $post = new Post;
        $post->title = $request->title;
        $post->body  = $request->body;
        $user->post()->save($post);
        return redirect(route('post_index')) ;
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        // $this->authorize('isAdmin',Post::class);
        // if (Gate::denies('isAdmin',$post)) {
        //     abort(403);
        // }
        return view('edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->authorize('isAdmin',Post::class);
        // dd($id);
        // $user = $request->user();
        $post = Post::find($id);
        // if (Gate::denies('isAdmin',$post)) {
        //     abort(403);
        // }
        $post->title = $request->title;
        $post->body  = $request->body;

        $post->save();
        return redirect(route('dashboard'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('isAdmin',Post::class);
        $post = Post::destroy($id);
        // if (Gate::denies('isAdmin',$post)) {
        //     abort(403);
        // }
        return redirect(route('dashboard'));
    }
}
