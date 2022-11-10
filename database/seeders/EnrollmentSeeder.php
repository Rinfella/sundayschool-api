<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdded = 0;
        foreach(Group::get() as $group) {
            foreach(User::orderBy('id')->skip($userAdded)->take(15)->get() as $user) {
                Enrollment::create([
                    'user_id' => $user->id,
                    'group_id' => $group->id,
                    'session_id' => 1,
                    'full_attendance' => true,
                    'exam_honours' => false,
                    'absent_count' => 0,
                    'exam_marks' => 0,
                ]);
            }
            $userAdded+=15;
        }
    }
}
