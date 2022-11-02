<?php

use App\Models\Group;
use App\Models\Session;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Session::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Group::class);
            $table->boolean('full_attendance');
            $table->boolean('exam_honours');
            $table->unsignedTinyInteger('absent_count');
            $table->unsignedTinyInteger('exam_marks');
            $table->timestamps();

            $table->foreign('session_id')->references('id')->on('sessions')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('group_id')->references('id')->on('groups')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
};
