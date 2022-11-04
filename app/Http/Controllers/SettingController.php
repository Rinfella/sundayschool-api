<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index', [
            'settings' => Setting::get()
        ]);
    }

    public function create()
    {
        return view('settings.create', [
            'types' => $this->getTypes()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingRequest $request)
    {
        Setting::create($request->all());

        return redirect('/admin/settings-config')->with('messageSuccess', 'Setting created');
    }

    public function showSiteSettingsForm()
    {
        return view('settings.site', ['settings' => Setting::get()]);
    }

    public function submitSiteSettingsForm(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return redirect('/admin/settings')->with('messageSuccess', 'Settings updated');
    }

    public function getTypes()
    {
        return [
            'text' => 'Text',
            'number' => 'Number',
            'email' => 'Email',
            'tel' => 'Phone Number',
            'textarea' => 'Textarea',
            'select' => 'Select',
            'radio' => 'Radio',
            'checkbox' => 'Checkbox',
        ];
    }
}
