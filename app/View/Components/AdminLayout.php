<?php

namespace App\View\Components;

use App\Models\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class AdminLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $title = 'Sunday School Management';
        $academicSessions = Session::select(['id', 'year'])->get();
        $currentAcademicSession = $academicSessions->first(function ($item) {
            return $item->id == session('currentAcademicSession');
        });

        // $title = Route::currentRouteName() . ' ' . $title;

        return view('layouts.admin', [
            'title' => $title,
            'academicSessions' => $academicSessions,
            'currentAcademicSession' => $currentAcademicSession,
        ]);
    }
}
