<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Degree;
use App\Models\Student;
use App\Models\UserAccounts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['degree', 'userAccount'])->paginate(2);

        if (request()->ajax()) {
            return response()->json([
                'html' => view('partials.students-table', compact('students'))->render(),
            ]);
        }

        return view('student', [
            'students' => $students,
            'userAccount' => session('user_account'),
        ]);
    }

    public function create()
    {
        $degrees = Degree::orderBy('degree_title')->get();

        return view('add_student')
            ->with('degrees', $degrees);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|min:2',
            'lname' => 'required|min:2',
            'mname' => 'nullable|min:2',
            'contactno' => 'required|digits:11',
            'degree_id' => 'required|exists:degrees,id',
            'email' => 'required|email|unique:students,email|unique:user_accounts,email',
            'username' => 'required|unique:user_accounts,username',
            'password' => 'required|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = UserAccounts::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => 'student',
            'must_change_password' => true,
        ]);

        $student = Student::create([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'mname' => $request->input('mname'),
            'email' => $request->input('email'),
            'contactno' => $request->input('contactno'),
            'degree_id' => $request->input('degree_id'),
            'user_account_id' => $user->id,
        ]);

        Log::info('New student added.', ['student_id' => $student->id, 'user_account_id' => $user->id]);

        $students = Student::with(['degree', 'userAccount'])->paginate(2);

        $response = [
            'message' => 'Student saved successfully.',
            'html' => view('partials.students-table', compact('students'))->render(),
            'student' => $student->load(['degree', 'userAccount']),
        ];

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json($response);
        }

        return redirect()->route('student.index')->with('success', $response['message']);
    }

    public function show(Request $request, string $id)
    {
        $student = Student::with(['degree', 'userAccount'])->findOrFail($id);

        return response()->json([
            'title' => 'Student Details',
            'html' => view('partials.student-details', compact('student'))->render(),
        ]);
    }

    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $degrees = Degree::orderBy('degree_title')->get();

        return view('edit_student')
            ->with('student', $student)
            ->with('degrees', $degrees);
    }

    public function update(Request $request, string $id)
    {
        $student = Student::with('userAccount')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('students', 'email')->ignore($student->id),
                Rule::unique('user_accounts', 'email')->ignore($student->user_account_id),
            ],
            'contactno' => 'required|string|max:255',
            'degree_id' => 'nullable|exists:degrees,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $student->update([
            'fname' => $request->input('fname'),
            'mname' => $request->input('mname'),
            'lname' => $request->input('lname'),
            'email' => $request->input('email'),
            'contactno' => $request->input('contactno'),
            'degree_id' => $request->input('degree_id'),
        ]);

        if ($student->userAccount) {
            $student->userAccount->update([
                'email' => $request->input('email'),
            ]);
        }

        Log::info('Student updated.', ['student_id' => $student->id]);

        $students = Student::with(['degree', 'userAccount'])->paginate(2);

        $response = [
            'message' => 'Student updated successfully.',
            'html' => view('partials.students-table', compact('students'))->render(),
            'studentDetailsHtml' => view('partials.student-details', ['student' => $student->fresh(['degree', 'userAccount'])])->render(),
        ];

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json($response);
        }

        return redirect()->route('student.index')->with('success', $response['message']);
    }

    public function destroy(Request $request, string $id)
    {
        $student = Student::with('userAccount')->findOrFail($id);

        if ($student->userAccount) {
            $student->userAccount->delete();
        }

        $student->delete();

        Log::info('Student deleted.', ['student_id' => $student->id]);

        $students = Student::with(['degree', 'userAccount'])->paginate(2);

        $response = [
            'message' => 'Student deleted successfully.',
            'html' => view('partials.students-table', compact('students'))->render(),
        ];

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json($response);
        }

        return redirect()->route('student.index')->with('success', $response['message']);
    }
}
