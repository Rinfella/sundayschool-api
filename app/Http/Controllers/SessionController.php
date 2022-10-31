<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Models\Session;
use App\Models\User;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::get();
        $viewData = [
            'sessions' => $sessions
        ];
        // dd($areas->toArray());
        return view('sessions.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSessionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSessionRequest $request)
    {
        try {
            Session::create($request->all());
            return redirect('/admin/sessions')->with('messageSuccess', 'Created Successfully');
        } catch (\Throwable $th) {
            return redirect('/sessions/create')->with('messageError', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        return view('sessions.edit', [
            'session' => $session,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSessionRequest  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSessionRequest $request, Session $session)
    {
        $session->year = $request->input('year');
        $session->end_month = $request->input('end_month');
        $session->start_month = $request->input('start_month');
        $session->honor_cutoff = $request->input('honor_cutoff');
        $session->exam_full_mark = $request->input('exam_full_mark');
        $session->total_number_of_sunday_schools = $request->input('total_number_of_sunday_schools');
        $session->save();

        return redirect('/admin/sessions/')->with('messageSuccess', $session->name . 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        $session->delete();
        return redirect('/admin/sessions')->with('messageSuccess', $session->name. 'Deleted Successfully');
    }
}
