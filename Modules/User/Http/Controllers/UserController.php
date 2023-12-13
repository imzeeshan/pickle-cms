<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Redirect;
use Modules\Roles\Entities\Role;
use Modules\Roles\Entities\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Settings\Entities\Setting;
use Maatwebsite\Excel\Facades\Excel;
use Modules\User\Exports\UsersExport;
use Modules\User\Imports\UsersImport;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $is_api     = \Request::is('api*');
        $site_title = Setting::where('key', 'Site Title')->get()->pluck('value')->first();
        $site_desc  = Setting::where('key', 'Site Description')->get()->pluck('value')->first();
        $users      = User::with('role')->sortable()->paginate(10);

        if ($is_api) {
            return $users;
        } else {
            return view('user::index', compact('users', 'site_title', 'site_desc'));
        }
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $roles = Role::all();
        return view('user::create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $user = new User();

        if ($request->name)
            $user->name = $request->name;

        if ($request->email)
            $user->email = $request->email;

        $user->password = bcrypt($request->password);

        if ($request->role_id)
            $user->role_id = $request->role_id;

        $user->save();
        Log::Info("New User ($user->name) Created Successfully");

        $is_api     = \Request::is('api*');

        if ($is_api) {
            return $user;
        } else {
            return Redirect::route('user.index')->with('message', 'User: ' . $request->name . ' has been added successfully!');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $user   = User::with('role')->findOrFail($id);
        $is_api = \Request::is('api*');

        if ($is_api) {
            return $user;
        } else {
            return view('user::show', compact('user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $user  = User::findOrFail($id);
        $roles = Role::all();

        return view('user::edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->get('name'))
            $user->name = $request->get('name');

        if ($request->get('email'))
            $user->email = $request->get('email');

        if ($request->get('password'))
            $user->password = bcrypt($request->get('password'));

        if ($request->role_id)
            $user->role_id = $request->role_id;

        $user->save();

        $is_api     = \Request::is('api*');
        if ($is_api) {
            return $user;
        } else {
            return Redirect::route('user.index')->with('message', 'User updated!');
        }
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $user->status = "deleted";

        $is_api     = \Request::is('api*');
        if ($is_api) {
            return response($user, 200)
                ->header('Content-Type', 'text/json');
        } else {

            return Redirect::route('user.index')->with('message', 'User deleted !');
        }
    }

    public function download()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import()
    {
        Excel::import(new UsersImport, "users-import-template.xls");

        return Redirect::route('user.index')->with('message', 'Users imported successfully!');
    }

    public function create_token(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user   = Auth::user();
            $token  = $user->createToken('login');
            $user->token = $token;
            return response($user, 200);
        } else {
            return response("User Not Found", 404)
                ->header('Content-Type', 'text/json');
        }
    }

    public function revoke_token(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user   = Auth::user();
            $user->tokens()->delete();
            $user->token = "";
            return response($user, 200);
        } else {
            return response("User Not Found", 404)
                ->header('Content-Type', 'text/json');
        }
    }
}
