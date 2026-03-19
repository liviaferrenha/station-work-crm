<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {

            $table->string('company_name')->nullable()->after('expected_revenue');

            $table->string('company_address')->nullable();

            $table->string('job_title')->nullable();

            $table->text('notes')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {

            $table->dropColumn([
                'company_name',
                'company_address',
                'job_title',
                'notes'
            ]);

        });
    }
};