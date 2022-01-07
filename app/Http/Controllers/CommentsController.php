<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('delete');
    }

    public function save(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'numeric',
            'author' => 'required|string|min:3|max:32',
            'content' => 'required|string',
            'captcha' => 'required|captcha'
        ]);

        $data = $request->input();
        try {
            $comment = new Comment();
            $comment->author = $data['author'];
            $comment->content = $data['content'];
            $comment->post_id = $data['id'];
            $comment->save();
            return Redirect::back()->with('success', 'Successfully create comment.');
        } catch (\Exception $e) {
            if (app()->environment(['local', 'staging'])) {
                return Redirect::back()->with('failed', 'Could not save comment. ' . $e);
            }

            return Redirect::back()->with('failed', 'Could not save comment.');
        }
    }

    public function delete(int $id): RedirectResponse
    {
        Comment::destroy($id);
        return Redirect::back();
    }
}
