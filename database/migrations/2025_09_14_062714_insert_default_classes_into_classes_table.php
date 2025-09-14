<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('classes')->insert([
            ['class_id' => 1, 'major' => 'PPLG'],
            ['class_id' => 2, 'major' => 'TJKT'],
            ['class_id' => 3, 'major' => 'Akuntansi'],
            ['class_id' => 4, 'major' => 'DKV'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('classes')->whereIn('class_id', [1,2,3,4])->delete();
    }
};
