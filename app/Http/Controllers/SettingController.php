<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;

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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingRequest $request)
    {
        dd($request->all());
        foreach($request->except('_token') as $key => $value) {
            if ($key == 'absent_types') {
                Setting::where('key', $key)->update([
                    'value' => json_encode([
                        'Damlo',
                        'Zin',
                        'Inkhawmpui',
                    ])
                ]);
            }
        }
    }

}
