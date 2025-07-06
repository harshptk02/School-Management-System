<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('student_profiles', function (Blueprint $table) {
            $table->string('profile_image')->nullable()->after('admission_date');
        });
    }

    public function down()
    {
        Schema::table('student_profiles', function (Blueprint $table) {
            $table->dropColumn('profile_image');
        });
    }
};