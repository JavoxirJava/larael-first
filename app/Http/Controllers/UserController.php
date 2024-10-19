<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function index() {
        return response('Bu userlar ruyxati', 200).header(' ');
    }

    public function show(Request $request, $user) {
        return view('users.show', ['name' => $user]);
    }

    public function create(Request $request) {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);
        return response()->view('users.success')->header('Refresh', '3;url=/login');
    }

    public function login(Request $request) {
        $password = $request->input('password');
        $user = User::where('name', $request->input('name'))->first();
        if ($user && Hash::check($password, $user->password)) {
            $posts = Post::all();
            return view('posts.posts', ['posts' => $posts, 'name' => $user->name]);
        }
        else return "Username yoki password xato";
    }

    public function store(Request $request) {
        dd($request->input('name'));
    }
}
