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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number', 15)->nullable()->after('email');
            $table->string('fathers_name')->nullable()->after('phone_number');
            $table->string('mothers_name')->nullable()->after('fathers_name');
            $table->date('date_of_birth')->nullable()->after('name');
            $table->enum('gender', ['Male', 'Female'])->after('date_of_birth');
            $table->string('address')->nullable()->after('mothers_name');
            $table->foreignId('area_id')->nullable();
            $table->foreignId('family_head_id')->nullable();
            $table->boolean('is_family_head')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
