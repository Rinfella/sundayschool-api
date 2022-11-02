<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Department;
use App\Models\Group;
use PHPUnit\TextUI\XmlConfiguration\Groups;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with([
            'department',
            'teacherAppointment.teacher',
            ])->paginate();

        return view('groups.index', [
            'groups' => $groups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create', [
            'departments' => Department::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        $departmentId = $request->input('department_id');
        $numberOfGroups = $request->input('number_of_groups');

        $department = Department::find($departmentId);

        $existingGroupsInDepartment = Group::where('department_id', $department->id)
            ->where('name', '!=', $department->name . ' Zirtirtu')
            ->count();

        for($i = $existingGroupsInDepartment; $i < $existingGroupsInDepartment + $numberOfGroups; $i++) {
            Group::create([
                'name' => $department->name . ' ' . ($i + 1),
                'department_id' => $department->id,
                'is_teacher_group' => false,
            ]);
        }

        $teacherGroupExists = Group::where('department_id', $department->id)
            ->where('name', '=', $department->name . ' Zirtirtu')
            ->count();

        if (!$teacherGroupExists) {
            Group::create([
                'name' => $department->name . ' Zirtirtu' ,
                'department_id' => $department->id,
                'is_teacher_group' => true,
            ]);
        }

        return redirect('/admin/groups/create')->with('messageSuccess', 'Groups created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupRequest  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect('/admin/groups');
    }
}
