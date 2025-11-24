<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('period_start');
            $table->date('period_end');
            $table->unsignedInteger('total_applications')->default(0);
            $table->unsignedInteger('completed_applications')->default(0);
            $table->decimal('total_revenue', 12, 2)->default(0);
            $table->text('summary')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
