<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->enum('status', [
                'New',
                'Contacted',
                'Qualified',
                'Converted',
                'Lost'
            ])->default('New');

            $table->string('source')->nullable();

            $table->integer('probability')->default(0);

            $table->decimal('expected_revenue', 10, 2)->nullable();

            $table->unsignedBigInteger('vendedor_id')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->timestamps();

            $table->softDeletes();

            $table->foreign('vendedor_id')
                ->references('id')
                ->on('vendedores')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};