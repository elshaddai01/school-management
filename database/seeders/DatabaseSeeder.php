<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AcademicClass;
use App\Models\Subject;
use App\Models\AcademicYear;
use App\Models\Sequence;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin account ──────────────────────────────────────
        User::create([
            'name'     => 'Principal Admin',
            'email'    => 'admin@school.cm',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // ── Teacher account ────────────────────────────────────
        User::create([
            'name'     => 'Jean Baptiste',
            'email'    => 'teacher@school.cm',
            'password' => Hash::make('password'),
            'role'     => 'teacher',
        ]);

        // ── Sample classes ─────────────────────────────────────
        AcademicClass::create(['name' => 'Form 3A', 'level' => 'Form 3', 'section' => 'A']);
        AcademicClass::create(['name' => 'Form 4B', 'level' => 'Form 4', 'section' => 'B']);

        // ── Sample subjects ────────────────────────────────────
        Subject::create(['name' => 'Mathematics',     'code' => 'MATH', 'coefficient' => 4]);
        Subject::create(['name' => 'English Language','code' => 'ENG',  'coefficient' => 4]);
        Subject::create(['name' => 'Physics',         'code' => 'PHY',  'coefficient' => 3]);

        // ── Academic year ──────────────────────────────────────
        $year = AcademicYear::create([
            'name'       => '2025-2026',
            'start_date' => '2025-09-01',
            'end_date'   => '2026-07-31',
            'is_active'  => true,
        ]);

        // ── Sequences (terms) ──────────────────────────────────
        Sequence::create(['name' => 'Sequence 1', 'academic_year_id' => $year->id,
                          'start_date' => '2025-09-01', 'end_date' => '2025-11-30']);
        Sequence::create(['name' => 'Sequence 2', 'academic_year_id' => $year->id,
                          'start_date' => '2025-12-01', 'end_date' => '2026-02-28']);
        Sequence::create(['name' => 'Sequence 3', 'academic_year_id' => $year->id,
                          'start_date' => '2026-03-01', 'end_date' => '2026-05-31']);
    }
}