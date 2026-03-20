<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AcademicClass extends Model
{
    use HasFactory;

    // Important: the real table name is 'classes'
    // because 'class' is a reserved word in PHP
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'level',
        'section',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'class_subject', 'class_id', 'subject_id');
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'teacher_subject', 'class_id', 'user_id')
                    ->withPivot('subject_id');
    }

    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class, 'class_id');
    }
}