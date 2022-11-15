<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMonthlyReportRequest;
use App\Http\Requests\UpdateMonthlyReportRequest;
use App\Models\MonthlyReport;

use App\Models\Enrollment;
use App\Models\Setting;
use Illuminate\Http\Request;

class MonthlyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function entry(Request $request)
    {
        if (!$request->has('month')) {
            return redirect('/admin/monthly-report/entry?month='.date('m'));
        }
        $month = $request->input('month');
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
        $total = 4;

        /**
         * 
         */
        foreach($enrollments as $enrollment) {
            $monthlyReportForCurrentEnrollment = MonthlyReport::where('enrollment_id', $enrollment->id)->where('month', $month)->first();
            $enrollment->present = $monthlyReportForCurrentEnrollment?->present;
            $enrollment->absent = $monthlyReportForCurrentEnrollment?->absent;
            $enrollment->total = $monthlyReportForCurrentEnrollment->total ?? $total;
            $total = $enrollment->total;
        }

        return view('attendance.monthly-report-entry', compact('enrollments', 'absentTypes', 'month', 'total'));
    }


    public function submit(Request $request)
    {
        $total = $request->input('total');
        $month = $request->input('month');
        foreach($request->input('enrollments') as $enrollment_id => $present) {
            $absent = $total - $present;
            MonthlyReport::updateOrCreate(compact('enrollment_id', 'month'), compact('present', 'absent', 'total'));
        }
        return redirect('/admin/monthly-report/entry')->with('messageSuccess', 'Monthly report saved successfully');
    }
}
