<?php

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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedsmallInteger('year');
            $table->unsignedTinyInteger('start_month')->default(1);
            $table->unsignedTinyInteger('end_month')->default(12);
            $table->unsignedSmallInteger('honour_cutoff')->default(90);
            $table->unsignedSmallInteger('exam_full_mark')->default(100);
            $table->unsignedTinyInteger('total_number_of_sunday_schools')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
};
