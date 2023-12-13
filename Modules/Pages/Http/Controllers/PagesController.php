<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pages\Entities\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Modules\User\Entities\User;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $pages = Page::paginate(10);
        return view('pages::index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pages::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $page_html = $request->page_html;
        $page_css  = $request->page_css;
        $page_css  = "<style>$page_css</style>";

        if ($page_html != '') {
            $request->description  = $page_css . $page_html;
        }

        $page               = new Page();
        $page->title        = $request->title;
        $page->slug         = Str::slug($page->title);
        $page->description  = $request->description;
        $page->created_by   = Auth::user()->id;
        $page->status       = $request->status ?: 0;
        $page->save();

        return Redirect::route('pages.index')->with('message', 'Page ' . $request->title . '  has been added successfully!');
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pages::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $page   = Page::findOrFail($id);
        $users  = User::all();

        return view('pages::edit', compact('page', 'users'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $page               = Page::findOrFail($id);
        $page->title        = $request->title;
        $page->slug         = Str::slug($page->title);
        $page->description  = $request->description;
        $page->created_by   = Auth::user()->id;
        $page->status       = $request->status ?: 0;
        $page->save();

        return Redirect::route('pages.index')->with('message', 'Page ' . $request->title . '  has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $page   = Page::findOrFail($id);
        $page->delete();

        return Redirect::route('pages.index')->with('message', 'Page has been deleted successfully!');
    }
}
