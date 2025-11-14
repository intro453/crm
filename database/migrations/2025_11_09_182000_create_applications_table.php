<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('manager_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('lawyer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('topic_id')->nullable()->constrained('request_topics')->nullOnDelete();
            $table->foreignId('court_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status');
            $table->string('type');
            $table->decimal('estimated_hours', 5, 2)->nullable();
            $table->decimal('cost', 12, 2)->default(0);
            $table->dateTime('scheduled_start_at')->nullable();
            $table->dateTime('scheduled_end_at')->nullable();
            $table->date('travel_date')->nullable();
            $table->text('description')->nullable();
            $table->text('completion_comment')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'type']);
            $table->index(['manager_id', 'lawyer_id']);
            $table->index('scheduled_start_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
