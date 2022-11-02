<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Models\Enrollment;
use App\Models\Group;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
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
     * @param  \App\Http\Requests\StoreEnrollmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnrollmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function edit(Enrollment $enrollment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEnrollmentRequest  $request
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->back()->with('messageSuccess', 'Enrolment deleted successfully');
    }

    public function createForGroup(Group $group)
    {
        $group->load('teacherAppointment');

        return view('enrollments.create-for-group', ['group' => $group]);
    }

    public function storeForGroup($groupId, Request $request)
    {
        foreach($request->input('user_id') as $userId) {
            if (!$userId) {
                continue;
            }
            Enrollment::create([
                'session_id' => session('currentAcademicSession'),
                'user_id' => $userId,
                'group_id' => $groupId,
                'full_attendance' => true,
                'exam_honours' => false,
                'absent_count' => 0,
                'exam_marks' => 0,
            ]);
        }

        return redirect('/admin/groups/' . $groupId . '/enrollments')->with('messageSuccess', 'Enrolled successfully');
    }

    public function showForGroup(Group $group)
    {
        $enrollments = Enrollment::with('user')
            ->where('session_id', session('currentAcademicSession'))
            ->where('group_id', $group->id)
            ->get();

        return view('enrollments.show-for-group',[
            'group' => $group,
            'enrollments' => $enrollments,
        ]);
    }
}
