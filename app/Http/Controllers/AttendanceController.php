<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Enrollment;
use App\Models\MonthlyReport;
use App\Models\Setting;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function entry(Request $request)
    {
        if (!$request->has('date')) {
            return redirect('/admin/attendance/entry?date='.date('Y-m-d'));
        }
        $date = $request->input('date');
        $groupId = $request->input('group_id');
        $groupId = 1;
        $session = session('currentAcademicSession');

        $absentTypes = Setting::where('key', 'absent_types')->first()->value;
        $absentTypes = json_decode($absentTypes);
        $enrollments = Enrollment::with('user')
            ->where('group_id', $groupId)
            ->where('session_id', $session->id)
            ->orderBy('id', 'desc')
            ->get();

        /**
         * He group chhunga enrollment zawng zawng te vawiin 
         * an absent/present chuan attendance edit duh
         * hunah absent/present angin an lo lang anga
         * attendance entry thar a nih chuan Present angin 
         */
        foreach($enrollments as $enrollment) {
            $attendanceForCurrentEnrollment = Attendance::where('enrollment_id', $enrollment->id)->where('date', $date)->first();
            $enrollment->status = $attendanceForCurrentEnrollment->status ?? 'Present';
        }

        return view('attendance.entry', compact('enrollments', 'absentTypes'));
    }

    public function submit(Request $request)
    {
        $date = $request->input('date');

        foreach($request->input('students') as $enrollmentId => $status) {
            Attendance::updateOrCreate([
                'enrollment_id' => $enrollmentId,
                'date' => $date,
            ], [
                'status' => $status
            ]);

            if ($status != 'Present') {
                $enrollment = Enrollment::find($enrollmentId);
                $enrollment->full_attendance = false;
                $enrollment->absent_count = Attendance::where('enrollment_id', $enrollmentId)
                    ->where('status', '!=', 'Present')
                    ->count();
                $enrollment->save();
            }

            $presentCountThisMonth = Attendance::where('enrollment_id', $enrollmentId)
                ->whereDate('date', '>=', now()->startOfMonth())
                ->where('status', 'Present')
                ->count();

            $absentCountThisMonth = Attendance::where('enrollment_id', $enrollmentId)
                ->whereDate('date', '>=', now()->startOfMonth())
                ->where('status', '!=', 'Present')
                ->count();
            $total = $presentCountThisMonth + $absentCountThisMonth;
            MonthlyReport::updateOrCreate([
                'enrollment_id' => $enrollmentId,
                'month' => date('m', strtotime($date)),
            ], [
                'present' => $presentCountThisMonth,
                'absent' => $absentCountThisMonth,
                'total' => $total
            ]);
        }

        return redirect('/admin/attendance/entry',);
    }

    public function viewReport()
    {
        $year = session('currentAcademicSession')->year;
        $sessionId = session('currentAcademicSession')->id;
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $timestamp = mktime(0, 0, 0, $i, 1);
            $monthNumber = date('n', $timestamp);
            $months[$monthNumber] = [
                'name' => date('F', $timestamp),
                'sundays' => $this->getSundays($year, $monthNumber),
            ];
        }
        $groupId = 1;

        $enrollments = Enrollment::with([
                'user' => function ($q) {
                    $q->select(['id', 'name']);
                }
            ])
            ->where('session_id', $sessionId)
            ->where('group_id', $groupId)
            ->select(['user_id', 'id'])
            ->get()
            ->keyBy('id');
        
        $attendances = Attendance::whereYear('date', '=', $year)->get()->groupBy([
            'enrollment_id',
            function ($item) {
                return $item->date;
            }
        ]);
        return view('attendance.report', [
            'year' => $year,
            'months' => $months,
            'groupId' => $groupId,
            'attendances' => $attendances,
            'enrollments' => $enrollments,
        ]);
    }

    public function getSundays($y,$m){ 
        $date = "$y-$m-01";
        $first_day = date('N',strtotime($date));
        $first_day = 7 - $first_day + 1;
        $last_day =  date('t',strtotime($date));
        $days = array();
        for($i=$first_day; $i<=$last_day; $i=$i+7 ){
            $days[] = $i;
        }
        return  $days;
    }   
}
