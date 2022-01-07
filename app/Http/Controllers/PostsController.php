<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function index()
    {
        $posts = DB::table('posts')->latest()->paginate(8);
        return view('posts.index', compact('posts'));
    }

    public function show(int $postId)
    {
        $post = Post::find($postId);
        if ($post == null) {
            return redirect(route('home'));
        }
        return view('posts.show', ['p' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function newPost(Request $request) {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'content' => 'required|string',
            'image' => 'nullable'
        ]);

        $data = $request->input();

        if ($request->hasFile('image')) {
            try {
                $data['image'] = $this->saveImage($request->file('image'));
            } catch (Exception $e) {
                return redirect(route('create_post'))->with('failed', 'Could not upload image due to insufficient disk space.');
            }
        }

        try {
            $post = new Post();
            $post->name = $data['name'];
            $post->content = $data['content'];
            $post->user_id = Auth::id();
            if (array_key_exists('image', $data)) {
                $post->image = $data['image'];
            }
            $post->save();
            return redirect(route('create_post'))->with('status', 'New post created successfully.');
        } catch (Exception $e) {
            if (app()->environment(['local', 'staging'])) {
                return redirect(route('create_post'))->with('failed', 'Could not save post. '.$e);
            }

            return redirect(route('create_post'))->with('failed', 'Could not save post.');
        }
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'numeric',
            'name' => 'required|string|min:1|max:255',
            'content' => 'required|string',
            'image' => 'nullable'
        ]);

        $data = $request->input();
        if ($request->hasFile('image')) {
            try {
                $data['image'] = $this->saveImage($request->file('image'));
            } catch (Exception $e) {
                return redirect(route('create_post'))->with('failed', 'Could not upload image due to insufficient disk space.');
            }
        }

        try {
            $post = Post::find($data['id']);
            $post->name = $data['name'];
            $post->content = $data['content'];
            $post->user_id = Auth::id();
            if (array_key_exists('image', $data)) {
                $post->image = $data['image'];
            }
            $post->save();
            return redirect(route('edit_post', ['id' => $data['id']]))->with('status', 'Post updated successfully.');
        } catch (Exception $e) {
            if (app()->environment(['local', 'staging'])) {
                return Redirect::back()->with('failed', 'Could not save post. '.$e);
            }

            return Redirect::back()->with('failed', 'Could not save post.');
        }
    }

    public function edit(int $postId)
    {
        return view('posts.edit', ['p' => Post::find($postId)]);
    }

    public function delete(int $id)
    {
        $post = Post::find($id);
        if ($post->hasImageAttached()) {
            Storage::delete('public/'.$post->image);
        }

        $post->delete();
        return redirect(route('posts'))->with('status', 'Removed post successfully.');
    }
}
