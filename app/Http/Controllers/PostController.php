<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostStatus;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::with('user')->get();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('post.create', compact('users', 'categories'));
    }

    public function store(PostRequest $request, Post $post)
    {

        $category = Category::find($request->categories);
        $post->create($request->validated())->categories()->attach($category);
        $user = User::find($request->user_id);
        
        if($user)
        {
            $user->notify(new PostStatus("წარმატებით დაემატა ახალი პოსტი"));
        }
        return back()->with('Success', 'ახალი პოსტი წარმატებით დაემატა');
    }

    public function edit($id)
    {
        $users = User::all();
        $categories = Category::all();
        $post = Post::findOrFail($id);
        return view('post.edit', compact('users', 'categories', 'post'));
    }

    public function update(PostRequest $request, $id)
    {
        $category = Category::find($request->categories);
        $post = Post::findOrFail($id);

        $post->categories()->sync([]);

        $post->title = $request->title;
        $post->user_id = $request->user_id;
        $post->save();

        $post->categories()->attach($category);
        return back()->with('Success', 'ამანათი წარმატებით დარედაქტირდა');
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return back()->with('Success', 'ამანათი წარმატებით წაიშალა');
    }
    
    public function postPublish(Request $request)
    {
        $id = $request->id;
        $post = Post::where('published', '0')->where('id', $id)->first();
        if($post)
        {
            $post->published = 1;
            $post->save();
            return response()->json(['status' => 'yes']);
        }
        else
        {
            return response()->json(['status' => 'no']);
        }
    }
}
