<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('nis', 8);
            $table->text('address');
            $table->string('phone_number', 13);
            $table->string('foto');

            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('spp_id');

            $table->renameColumn('id', 'student_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
