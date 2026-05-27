<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class StudentCoursesSeeder extends Seeder
{
    public function run(): void
    {
        $userOne = User::query()->updateOrCreate(
            ['email' => 'juan@example.com'],
            [
                'name' => 'Juan Dela Cruz',
                'password' => Hash::make('password123'),
            ]
        );

        $userTwo = User::query()->updateOrCreate(
            ['email' => 'maria@example.com'],
            [
                'name' => 'Maria Santos',
                'password' => Hash::make('password123'),
            ]
        );

        $studentOneData = [
            'fname' => 'Juan',
            'mname' => 'D.',
            'lname' => 'Dela Cruz',
            'email' => 'juan.student@example.com',
            'contactno' => '09123456789',
            'degree_id' => null,
        ];

        $studentTwoData = [
            'fname' => 'Maria',
            'mname' => 'S.',
            'lname' => 'Santos',
            'email' => 'maria.student@example.com',
            'contactno' => '09987654321',
            'degree_id' => null,
        ];

        if (Schema::hasColumn('students', 'user_id')) {
            $studentOneData['user_id'] = $userOne->id;
            $studentTwoData['user_id'] = $userTwo->id;
        }

        $studentOne = Student::query()->updateOrCreate(
            ['email' => 'juan.student@example.com'],
            $studentOneData
        );

        $studentTwo = Student::query()->updateOrCreate(
            ['email' => 'maria.student@example.com'],
            $studentTwoData
        );

        $course = Course::query()->updateOrCreate(
            ['course_name' => 'Database Systems']
        );

        DB::table('course__students')->updateOrInsert(
            ['course_id' => $course->id, 'student_id' => $studentOne->id],
            ['updated_at' => now(), 'created_at' => now()]
        );

        DB::table('course__students')->updateOrInsert(
            ['course_id' => $course->id, 'student_id' => $studentTwo->id],
            ['updated_at' => now(), 'created_at' => now()]
        );
    }
}
