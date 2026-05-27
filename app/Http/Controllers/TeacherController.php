<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\UserAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('userAccount')->orderBy('lname')->paginate(5);

        return view('teacher.index', ['teachers' => $teachers]);
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:teachers,email|unique:user_accounts,email',
            'contactno' => 'required|string|max:20',
            'username' => 'required|string|max:255|unique:user_accounts,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = UserAccounts::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'teacher',
            'must_change_password' => true,
        ]);

        Teacher::create([
            'fname' => $validated['fname'],
            'mname' => $validated['mname'] ?? null,
            'lname' => $validated['lname'],
            'email' => $validated['email'],
            'contactno' => $validated['contactno'],
            'user_account_id' => $user->id,
        ]);

        return redirect()->route('teacher.index')->with('success', 'Teacher added successfully.');
    }

    public function show(string $id)
    {
        $teacher = Teacher::with('userAccount')->findOrFail($id);

        return view('teacher.show', ['teacher' => $teacher]);
    }

    public function edit(string $id)
    {
        $teacher = Teacher::with('userAccount')->findOrFail($id);

        return view('teacher.edit', ['teacher' => $teacher]);
    }

    public function update(Request $request, string $id)
    {
        $teacher = Teacher::with('userAccount')->findOrFail($id);

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('teachers', 'email')->ignore($teacher->id),
                Rule::unique('user_accounts', 'email')->ignore($teacher->user_account_id),
            ],
            'contactno' => 'required|string|max:20',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('user_accounts', 'username')->ignore($teacher->user_account_id),
            ],
        ]);

        $teacher->update([
            'fname' => $validated['fname'],
            'mname' => $validated['mname'] ?? null,
            'lname' => $validated['lname'],
            'email' => $validated['email'],
            'contactno' => $validated['contactno'],
        ]);

        if ($teacher->userAccount) {
            $teacher->userAccount->update([
                'username' => $validated['username'],
                'email' => $validated['email'],
            ]);
        }

        return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(string $id)
    {
        $teacher = Teacher::with('userAccount')->findOrFail($id);

        if ($teacher->userAccount) {
            $teacher->userAccount->delete();
        }

        $teacher->delete();

        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully.');
    }
}
