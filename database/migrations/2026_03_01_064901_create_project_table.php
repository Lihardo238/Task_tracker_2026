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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('deskripsi');
            $table->enum('status', ['on-going', 'completed', 'pending', 'cancelled']);
            $table->foreignId('partner_id')->nullable()->constrained('partnerships')->nullOnDelete();
            $table->string('partner_name');
            $table->foreignId('created_user_id')->constrained('users');
            $table->foreignId('PM_id')->constrained('users');
            $table->date('dueDate');
            $table->timestamps();
        });

        Schema::create('check_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('pm_id')->constrained('users');
            $table->string('title');
            $table->date('dueDate');
            $table->timestamps();
        });

        Schema::create('joint_workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('pm_id')->constrained('users');
            $table->foreignId('worker_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project');
        Schema::dropIfExists('joint_worker');
        Schema::dropIfExists('check_point');
    }

};
