<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('qr_codes', function (Blueprint $table): void {
            $table->string('slug')->nullable()->unique()->after('id');
        });

        DB::table('qr_codes')->whereNull('slug')->orderBy('id')->eachById(function (object $qrCode): void {
            DB::table('qr_codes')->where('id', $qrCode->id)->update(['slug' => Str::lower(Str::random(12))]);
        });
    }

    public function down(): void
    {
        Schema::table('qr_codes', function (Blueprint $table): void {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
