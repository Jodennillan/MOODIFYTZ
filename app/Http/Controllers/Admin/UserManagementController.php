<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    public function addTherapist(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','email','max:255', Rule::unique('users', 'email')],
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'therapist',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users')->with('success', 'Therapist added successfully.');
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.edit-user', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,'.$user->id,
        'role' => 'required|in:user,therapist,admin',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return redirect()->route('admin.users')->with('success', 'User updated successfully.');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.users')->with('success', 'User deleted.');
}
}
