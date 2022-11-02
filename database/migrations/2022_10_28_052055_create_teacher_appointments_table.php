<?php

use App\Models\Department;
use App\Models\Group;
use App\Models\Teacher;
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
        Schema::create('teacher_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Teacher::class);
            $table->foreignIdFor(Department::class);
            $table->foreignIdFor(Group::class);
            $table->tinyInteger('start_month');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teachers')->cascadeOnDelete();
            $table->foreign('department_id')->references('id')->on('departments')->cascadeOnDelete();
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
        Schema::dropIfExists('teacher_appointments');
    }
};
