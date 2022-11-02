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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Name of Church
            $table->string('key')->unique(); // nameOfChurch
            $table->text('value'); // Presbyterian Church of India, Khatla Kohhran
            $table->string('type')->default('text'); // text, textarea, number, radio, checkbox etc
            $table->text('options')->nullable(); // dark, light, green, white theme
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
        Schema::dropIfExists('settings');
    }
};
