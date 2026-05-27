<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\User;
use App\Models\Student;
use App\Models\Profile;

class PagesController extends Controller
{
    public function userProfile()
    {
        $user = User::with('profile')->firstOrFail();

        return $user->name . ' - ' . $user->profile->bio;
    }

    public function userPost()
    {
        $user = User::with('posts')->firstOrFail();
        $output = '';

        foreach ($user->posts as $post) {
            $output .= $user->name . ': ' . $post->content . ' - ' . $post->title . '<br>';
        }

        return $output;
    }
    
    public function studentCourses()
    {
        $users = User::with('student.courses')
            ->whereHas('student.courses')
            ->get();

        if ($users->isEmpty()) {
            return 'No student-course data found.';
        }

        $output = '';

        foreach ($users as $user) {
            $student = $user->student;

            foreach ($student->courses as $course) {
                $output .= $user->name . ' is enrolled in ' . $course->course_name . '<br>';
            }
        }

        return $output;
    }

    public function maintenance(): View
    {
        return view('maintenance');
    }

    public function welcomeStudent(Request $request): View
    {
        return view('welcomeStudent', [
            'userAccount' => $request->session()->get('user_account'),
        ]);
    }
}
