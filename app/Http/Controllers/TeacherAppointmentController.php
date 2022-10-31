<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherAppointmentRequest;
use App\Http\Requests\UpdateTeacherAppointmentRequest;
use App\Models\TeacherAppointment;

class TeacherAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeacherAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherAppointmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherAppointment  $teacherAppointment
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherAppointment $teacherAppointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherAppointment  $teacherAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherAppointment $teacherAppointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeacherAppointmentRequest  $request
     * @param  \App\Models\TeacherAppointment  $teacherAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherAppointmentRequest $request, TeacherAppointment $teacherAppointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherAppointment  $teacherAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherAppointment $teacherAppointment)
    {
        //
    }
}
