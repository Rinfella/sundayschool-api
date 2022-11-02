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
        $academicSession = Session::get('currentAcademicSession');
        if($request->input('currentAcademicSession')) {
            Session::put('currentAcademicSession', $request->input('currentAcademicSession'));
                // $request->offsetUnset('currentAcademicSession');
                return redirect()->to($request->fullUrlWithoutQuery('currentAcademicSession'));

                return $next($request);
        }

        if(!$academicSession) {
            $latestAcademicSession = AcademicSession::latest()->first();
            $latestAcademicSessionId = $latestAcademicSession ? $latestAcademicSession->id : null;

            $academicSession = $latestAcademicSessionId;
            Session::put('currentAcademicSession', $academicSession);
        }

        return $next($request);
    }
}
