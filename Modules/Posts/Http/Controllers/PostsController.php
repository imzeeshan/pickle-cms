<?php

namespace Modules\Posts\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Media\Entities\Media;
use Modules\Posts\Entities\Category;
use Modules\Posts\Entities\Post;
use Modules\User\Entities\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts::index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = Category::all();
        $users      = User::all();
        return view('posts::create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $post             = new Post();
        $media            = new Media();

        $post->title        = $request->title;
        $post->slug         = Str::slug($request->title);
        $post->category_id  = $request->category;
        $post->description  = $request->description;
        $post->tags         = json_encode($request->tags);
        $post->status       = $request->status ?: 0;
        $post->created_by   = Auth::user()->id;

        //save the media now
        if ($request->file('file_upload')) {
            $file_extension      = $request->file('file_upload')->getClientOriginalExtension();

            $media->title        = $request->title;
            $media->type         = $request->type ?: 0;
            $media->description  = $request->description;
            $media->name         = Str::slug($media->title);
            $media->created_by   = Auth::user()->id;

            $file_name           = $media->name . "." . $file_extension;
            $request->file_upload->move(public_path('media/images'), $file_name);
            $media->url          = env('APP_URL') . "/media/images/$media->name.$file_extension";
            $media->save();

            $post->image = $media->url;
        }
        $post->save();

        return Redirect::route('posts.index')->with('message', 'Post :- ' . $request->title . '  has been created successfully!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('posts::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $categories = Category::all();
        $users      = User::all();
        $post       = Post::findOrFail($id);

        return view('posts::edit', compact('categories', 'users', 'post'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $post               = Post::findOrFail($id);
        $post->title        = $request->title;
        $post->slug         = Str::slug($request->title);
        $post->category_id  = $request->category;
        $post->description  = $request->description;
        $post->tags         = json_encode($request->tags);
        $post->status       = $request->status ?: 0;
        $post->created_by   = Auth::user()->id;

        //save the media, only if file was uploaded.

        if ($request->has('file_upload')) {
            // Delete existing image
            $media = Media::where('url', $post->image);
            $media->delete();

            // now upload the new media.
            $media               = new Media();
            $file_extension      = $request->file('file_upload')->getClientOriginalExtension();

            $media->title        = $request->title;
            $media->type         = $request->type ?: 0;
            $media->description  = $request->description;
            $media->name         = Str::slug($media->title);
            $media->created_by   = Auth::user()->id;

            $file_name           = $media->name . "." . $file_extension;
            $request->file_upload->move(public_path('media/images'), $file_name);
            $media->url          = env('APP_URL') . "/media/images/$media->name.$file_extension";
            $media->save();

            $post->image = $media->url;
        }

        $post->save();

        return Redirect::route('posts.index')->with('message', 'Post :- ' . $request->title . '  has been created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $post       = Post::findOrFail($id);
        $post->delete();
        return Redirect::route('posts.index')->with('message', 'Post deleted!');
    }
}
