<?php

namespace Modules\Posts\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Posts\Entities\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('posts::categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('posts::categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name         = $request->name;
        $category->parent_id    = $request->parent_id ?: 0; //0 by default
        $category->save();

        return Redirect::route('categories.index')->with('message', 'Category created!');
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
        $category = Category::findOrFail($id);
        return view('posts::categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name         = $request->name;
        $category->parent_id    = $request->parent_id ?: 0; //0 by default
        $category->save();

        return Redirect::route('categories.index')->with('message', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return Redirect::route('categories.index')->with('message', 'Category deleted!');
    }
}
