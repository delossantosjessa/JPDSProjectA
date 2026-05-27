<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\UserAccounts;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userAccount = $request->session()->get('user_account');
        $role = $userAccount['role'] ?? null;

        if ($role === 'admin') {
            return view('dashboard.admin', [
                'userAccount' => $userAccount,
                'studentCount' => Student::count(),
                'teacherCount' => Teacher::count(),
                'degreeCount' => Degree::count(),
                'accountCount' => UserAccounts::count(),
            ]);
        }

        if ($role === 'teacher') {
            return view('dashboard.teacher', [
                'userAccount' => $userAccount,
                'teacher' => Teacher::where('user_account_id', $userAccount['id'])->first(),
            ]);
        }

        return view('dashboard.student', [
            'userAccount' => $userAccount,
            'student' => Student::with('degree')
                ->where('user_account_id', $userAccount['id'])
                ->first(),
        ]);
    }
}
