<?php

namespace App\Http\Middleware;

use App\Models\Session as AcademicSession;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SetAcademicSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $academicSession = session('currentAcademicSession');
        if($request->input('currentAcademicSession')) {
            $currentAcademicSession = AcademicSession::find($request->input('currentAcademicSession'));
            Session::put('currentAcademicSession', $currentAcademicSession);

            return redirect()->to($request->fullUrlWithoutQuery('currentAcademicSession'));
        }

        if(!$academicSession) {
            $latestAcademicSession = AcademicSession::latest()->first();
            if (!$latestAcademicSession) {
                return redirect('/admin/sessions/create')->with('messageError', 'Please create session');
            }
            Session::put('currentAcademicSession', $academicSession);
        }

        return $next($request);
    }
}
