<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Enrollment;
use App\Models\Group;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function entry(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));
        $groupId = $request->input('group_id');
        $groupId = 1;
        $session = session('currentAcademicSession');

        $departments = Department::get();
        $currentStep = $request->input('currentStep', 1);
        $departmentId = $request->input('department_id');
        $groupId = $request->input('group_id');

        $groups = Group::where('department_id', $departmentId)->get();
        $users = $currentStep ==3 ? User::get() : [];


        $absentTypes = Setting::where('key', 'absent_types')->first()->value;
        $absentTypes = json_decode($absentTypes);
        $enrollments = Enrollment::with('user')
            ->where('group_id', $groupId)
            ->where('session_id', $session->id)
            ->orderBy('id', 'desc')
            ->get();

        foreach($enrollments as $enrollment) {
            $attendanceForCurrentEnrollment = Attendance::where('enrollment_id', $enrollment->id)->where('date', $date)->first();
            $enrollment->status = $attendanceForCurrentEnrollment->status ?? 'Present';
        }

        return view('attendance.entry', compact('enrollments', 'absentTypes'), [
            'departments' => $departments,
            'groups' => $groups,
            'currentStep' => $currentStep,
            'departmentId' => $departmentId,
            'groupId' => $groupId,
        ]);
    }

    public function submit(Request $request)
    {
        $currentStep = $request->input('currentStep');

        if($currentStep == 1) {
            $this->validate($request, [
                'date' => 'required',
                'department_id' => 'required',
            ]);
            $data = $request->except('_token');
            $data['currentStep'] = $data['currentStep'] + 1;
            return redirect()->route('attendance.entry', $data);
        }

        if($currentStep == 2) {
            $this->validate($request, [
                'date' => 'required',
                'department_id' => 'required',
                'group_id' => 'required',
            ]);
            $data = $request->except('_token');
            $data['currentStep'] = $data['currentStep'] + 1;
            return redirect()->route('attendance.entry', $data);
        }

        if($currentStep == 3) {
            $this->validate($request, [
                'date' => 'required',
                'department_id' => 'required',
                'group_id' => 'required',
                'students' => 'required',
            ]);

            $date = $request->input('date');
            foreach ($request->input('students') as $enrollmentId => $status) {
                Attendance::updateOrCreate([
                    'enrollment_id' => $enrollmentId,
                    'date' => $date,
                ],
                [
                    'status' => $status,
                ]);
            }

            $data = $request->except('_token', 'currentStep', 'group_id', 'students');
            $data['currentStep'] = 2;
            return redirect()->route('attendance.entry', $data)->with('messageSuccess', 'Attendance created successfully');
        }

    }
}
