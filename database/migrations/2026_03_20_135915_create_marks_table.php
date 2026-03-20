<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                  ->constrained('students')
                  ->onDelete('cascade');
            $table->foreignId('subject_id')
                  ->constrained('subjects')
                  ->onDelete('restrict');
            $table->foreignId('class_id')
                  ->constrained('classes')
                  ->onDelete('restrict');
            $table->foreignId('sequence_id')
                  ->constrained('sequences')
                  ->onDelete('restrict');
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('restrict');
            $table->decimal('ca', 5, 2)->default(0);
            $table->decimal('exam', 5, 2)->default(0);
            $table->decimal('total', 5, 2)->default(0);
            $table->string('grade', 2)->default('F');
            $table->text('competence_remark')->nullable();
            $table->unique(['student_id', 'subject_id', 'sequence_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};