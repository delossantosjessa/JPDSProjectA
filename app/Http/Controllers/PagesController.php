<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\UserAccounts;

class PagesController extends Controller
{
    public function userProfile(Request $request): View
    {
        $userAccount = $request->session()->get('user_account');
        $account = UserAccounts::query()->findOrFail($userAccount['id']);
        $student = Student::with('degree')->where('user_account_id', $account->id)->first();
        $teacher = Teacher::where('user_account_id', $account->id)->first();

        return view('userProfile', [
            'userAccount' => $userAccount,
            'account' => $account,
            'student' => $student,
            'teacher' => $teacher,
        ]);
    }

    public function userPost(Request $request): View
    {
        return view('userPost', [
            'userAccount' => $request->session()->get('user_account'),
        ]);
    }
    
    public function studentCourses(Request $request): View
    {
        $userAccount = $request->session()->get('user_account');
        $student = Student::with('courses', 'degree')
            ->where('user_account_id', $userAccount['id'] ?? null)
            ->first();
        $allStudentCourses = collect();

        if (($userAccount['role'] ?? null) !== 'student') {
            $allStudentCourses = Student::with('courses', 'degree', 'userAccount')
                ->whereHas('courses')
                ->orderBy('lname')
                ->get();
        }

        return view('studentCourses', [
            'userAccount' => $userAccount,
            'student' => $student,
            'courses' => $student?->courses ?? collect(),
            'availableCourses' => Course::orderBy('course_name')->get(),
            'allStudentCourses' => $allStudentCourses,
        ]);
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
