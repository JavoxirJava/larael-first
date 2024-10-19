<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(){
        $posts = Post::all();
        return view('posts.posts', ['posts' => $posts]);
    }


    public function create(Request $request) {
        Post::create([
            'title' => $request->input('title'),
            'short_content' => $request->input('short_content'),
            'content' => $request->input('content'),
            'photo' => 'none.png',
        ]);
        return redirect('/posts');
    }

    public function update(Request $request, $id) {
        Post::find($id)->update([
            'title' => $request->input('title'),
            'short_content' => $request->input('short_content'),
            'content' => $request->input('content'),
            'photo' => 'none.png',
        ]);
        return redirect('/posts');
    }

    public function delete($id) {
        Post::destroy($id);
    }

    public function store(Request $request){
    }
}
