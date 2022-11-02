<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Department;
use App\Models\Group;
use App\Models\Session;
use App\Models\Teacher;
use App\Models\TeacherAppointment;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use stdClass;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewData = Teacher::with([
            'user',
            'session',
            'appointment.group',
            'appointment.department',
        ])->paginate();

        return view('teachers.index', [
            'teachers' => $viewData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $departments = Department::get();
        $sessions = Session::get();
        $months = $this->getMonths();

        $currentStep = $request->input('currentStep', 1);
        $sessionId = Session::latest()->first()->id;
        $sessionId = $request->input('session_id', $sessionId);
        $departmentId = $request->input('department_id');
        $groupId = $request->input('group_id');
        $userId = $request->input('user_id');
        $startMonth = $request->input('start_month', 1);

        $groups = Group::where('department_id', $departmentId)->get();
        $users = $currentStep == 3 ? User::get() : [];

        return view('teachers.create', [
            'departments' => $departments,
            'groups' => $groups,
            'users' => $users,
            'sessions' => $sessions,
            'months' => $months,
            'sessionId' => $sessionId,
            'currentStep' => $currentStep,
            'departmentId' => $departmentId,
            'groupId' => $groupId,
            'userId' => $userId,
            'startMonth' => $startMonth,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        $currentStep = $request->input('currentStep');

        if($currentStep == 1) {
            $this->validate($request, [
                'start_month' => 'required',
                'department_id' => 'required',
            ]);
            $data = $request->except('_token');
            $data['currentStep'] = $data['currentStep'] + 1;
            return redirect()->route('teachers.create', $data);
        }

        if($currentStep == 2) {
            $this->validate($request, [
                'start_month' => 'required',
                'department_id' => 'required',
                'group_id' => 'required',
            ]);
            $data = $request->except('_token');
            $data['currentStep'] = $data['currentStep'] + 1;
            return redirect()->route('teachers.create', $data);
        }

        if($currentStep == 3) {
            $this->validate($request, [
                'start_month' => 'required',
                'department_id' => 'required',
                'group_id' => 'required',
                'user_id' => 'required',
            ]);

            $existing = Teacher::where('user_id', $request->input('user_id'))
                ->where('session_id', $request->input('session_id'))
                ->count();
            
            if ($existing != 0) {
                throw ValidationException::withMessages(['user_id' => ['unique' => 'This user is already assigned as a teacher']]);
            }

            $data = $request->all();
            $data['session_id'] = session('currentAcademicSession');
            $teacher = Teacher::create($data);

            $teacherAppointmentData = $request->all();
            $teacherAppointmentData['teacher_id'] = $teacher->id;

            TeacherAppointment::create($teacherAppointmentData);

            $data = $request->except('_token', 'currentStep', 'group_id', 'user_id');
            $data['currentStep'] = 2;
            return redirect()->route('teachers.create', $data)->with('messageSuccess', 'Teacher created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeacherRequest  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    public function getMonths()
    {
        $months = [];

        for($i = 1; $i <= 12; $i++) {
            $dateObj   = DateTime::createFromFormat('!m', $i);
            $monthName = $dateObj->format('F');

            $monthObject = new stdClass();

            $monthObject->id = $i;
            $monthObject->name = $monthName;

            $months[] = $monthObject;
        }
        return $months;
    }
}
