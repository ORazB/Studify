<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // pastikan nullable
            $table->unsignedBigInteger('spp_id')->nullable()->change();

            // tambahkan FK dengan nullOnDelete
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['spp_id']);
            $table->unsignedBigInteger('spp_id')->nullable(false)->change();
            $table->foreign('spp_id')
                  ->references('id')->on('spps')
                  ->cascadeOnDelete();
        });
    }
};