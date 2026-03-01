<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class userController extends Controller
{

    //PUBLIC
    public function showAdminHome(){
        return view('admin.home');
    }

    public function showAdminpTask(){
        return view('admin.pTask.main');
    }

    public function showLoginForm()
    {
        return view('auth.loginForm');
    }

    public function showRegistForm()
    {
        return view('auth.registForm');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        Log::info('Attempting login with credentials:', $credentials);
    
        if (Auth::attempt($credentials)) {
            // Get the authenticated user
            $user = Auth::user();
    
            // Redirect users based on their role
            if ($user->role === 'admin') {
                return redirect()->route('admin.home');
            } elseif ($user->role === 'executive') {
                return redirect()->route('executiveApp');
            } elseif ($user->role === 'pm') {
                return redirect()->route('PMApp');
            }else {
                return redirect()->route('workerApp');
            }
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

//_______________________________________________________________________________________

//ADMIN && Executive
    // public function listUsers()
    // {
    //     $users = User::paginate(10); // Adjust the number of items per page as needed
    //     return view('admin.users.userList', compact('users'));
    // }   

    public function listUsers(Request $request)
    {
        $users = User::paginate(10);

        if ($request->ajax()) {
            return response()->json($users);
        }

        return view('admin.users.userList', compact('users'));
    }

    public function create()
    {
        return view('admin.users.createUser');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,executive,pm,worker',
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.updateUser', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,pm,worker',
            'status' => 'required|in:active,inactive',
        ]);
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    
    // public function destroy(User $user)
    // {
    //     $user->delete();
    //     return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    // }

    public function destroy(User $user)
    {
        $user->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('users.index');
    }
}
