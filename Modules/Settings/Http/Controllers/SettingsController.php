<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\Setting;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $settings = Setting::paginate(10);
        return view('settings::index', compact('settings'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('settings::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $setting         = new Setting();
        $setting->key    = $request->key;
        $setting->value  = $request->value;
        $setting->save();

        return Redirect::route('settings.index')->with('message', 'New Settings has been added successfully!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('settings::edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $setting         = Setting::findOrFail($id);
        $setting->key    = $request->key;
        $setting->value  = $request->value;
        $setting->save();

        return Redirect::route('settings.index')->with('message', 'Settings has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();

        return Redirect::route('settings.index')->with('message', 'Setting deleted!');
    }
}
