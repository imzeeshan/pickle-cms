<?php

namespace Modules\Roles\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Roles\Entities\Role;
use Illuminate\Support\Facades\Redirect;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('roles::index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('roles::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $role = new Role();

        if ($request->name)
            $role->name = $request->name;

        $role->save();

        return Redirect::route('roles.index')->with('message', 'Role: ' . $request->name . ' has been added successfully!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('roles::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles::edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        if ($request->name)
            $role->name = $request->name;

        $role->save();

        return Redirect::route('roles.index')->with('message', 'Role: ' . $request->name . ' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return Redirect::route('roles.index')->with('message', 'Role deleted!');
    }
}
