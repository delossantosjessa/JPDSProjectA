<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccounts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected function redirectToRoleDashboard(UserAccounts $user)
    {
        return redirect()->route('dashboard');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request){
        $sessionUser = $request->session()->get('user_account');

        if ($sessionUser) {
            if (($sessionUser['must_change_password'] ?? false) && !$request->isMethod('post')) {
                return redirect()->route('password.change.form', ['user' => $sessionUser['id']]);
            }

            if (!($sessionUser['must_change_password'] ?? false) && !$request->isMethod('post')) {
                return redirect()->route('dashboard');
            }
        }

        $user_name = $request -> input('username');
        $pass_word = $request -> input('password');

        //added to not diplay error when the page is first loaded without submitting the form
        if (!$request->filled('username') && !$request->filled('password')) {
            return view('login');
        }

        $user = UserAccounts::where('username', $user_name)->first();
        if($user && Hash::check($pass_word, $user->password)){
            Session::put('logged_id', $user->id);
            Session::put('user_account', [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
                'must_change_password' => (bool) $user->must_change_password,
            ]);

            if (in_array($user->role, ['student', 'teacher'], true) && $user->must_change_password) {
                return redirect()->route('password.change.form', ['user' => $user->id]);
            }

            return $this->redirectToRoleDashboard($user);
        } else{
            $message = "Wrong credentials. Please try again.";
            return view('login')->with("message", $message);
        }
    }

    public function logout()
    {
        Session::forget('logged_id');
        Session::forget('user_account');
        Session::flush();

        return redirect()->route('login');
    }

    public function showChangePasswordForm(Request $request)
    {
        $pendingUserId = $request->query('user');

        if (!$pendingUserId) {
            return redirect('/');
        }

        $user = UserAccounts::find($pendingUserId);

        if (!$user) {
            return redirect('/');
        }

        if (!$user->must_change_password) {
            return redirect()->route('dashboard');
        }

        return view('changePassword')->with('userId', $pendingUserId);
    }

    public function updatePassword(Request $request)
    {
        $pendingUserId = $request->input('user_id');

        if (!$pendingUserId) {
            return redirect('/');
        }

        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password|confirmed',
        ]);

        $user = UserAccounts::findOrFail($pendingUserId);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ])->withInput();
        }

        $user->update([
            'password' => Hash::make($validated['new_password']),
            'must_change_password' => false,
        ]);

        Session::put('user_account', [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
            'must_change_password' => false,
        ]);

        return $this->redirectToRoleDashboard($user);
    }
}
