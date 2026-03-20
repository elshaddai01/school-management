<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'coefficient',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(AcademicClass::class, 'class_subject', 'subject_id', 'class_id');
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'teacher_subject', 'subject_id', 'user_id')
                    ->withPivot('class_id');
    }

    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class);
    }
}