<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Media\Entities\Media;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $all_media = Media::paginate(10);
        return view('media::index', compact('all_media'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('media::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $media               = new Media();
        $media->title        = $request->title;
        $media->alt_text     = $request->alt_text;
        $media->type         = $request->type;
        $media->description  = $request->description;
        $media->name         = Str::slug($media->title);
        $media->created_by   = Auth::user()->id;
        $file_extension      = $request->file('file_upload')->getClientOriginalExtension();
        $file_name           = $media->name . "." . $file_extension;

        if ($media->type == 0) {
            $request->file_upload->move(public_path('media/images'), $file_name);
            $media->url = env('APP_URL') . "/media/images/$media->name.$file_extension";
        } else {
            $request->file_upload->move(public_path('media/videos'), $file_name);
            $media->url = env('APP_URL') . "/media/videos/$media->name.$file_extension";
        }

        $media->save();
        return Redirect::route('media.index')->with('message', 'Media uploaded successfully!');
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('media::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('media::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
