<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'class_id',
        'sequence_id',
        'user_id',
        'ca',
        'exam',
        'total',
        'grade',
        'competence_remark',
    ];

    // ── Auto-calculate total and grade before every save ───────

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function ($mark) {
            $mark->total = $mark->ca + $mark->exam;

            $mark->grade = match (true) {
                $mark->total >= 80 => 'A',
                $mark->total >= 70 => 'B',
                $mark->total >= 60 => 'C',
                $mark->total >= 50 => 'D',
                default            => 'F',
            };
        });
    }

    // ── Relationships ──────────────────────────────────────────

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function sequence(): BelongsTo
    {
        return $this->belongsTo(Sequence::class);
    }

    public function academicClass(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}