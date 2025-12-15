<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'role' => ['required', 'string', 'in:superadmin,admin'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Mengambil semua data KECUALI role
        $userData = collect($validated)->except('role')->toArray();
        // Simpan Data User
        $user = User::create($userData);
        // Assign Role User
        $user->assignRole($validated['role']);

        return redirect()->route('users.index')->with('success', 'Data pengguna baru berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        return view('users.edit', compact(['roles', 'user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'role' => ['required', 'string', 'in:superadmin,admin'],
            // 'password' => ['sometimes', 'nullable', 'confirmed', Password::defaults()],
            // Tambahkan 'exclude_if:password,' atau 'exclude_without:password'
            // Artinya: abaikan field ini dari hasil $validated jika nilainya kosong
            'password' => ['nullable', 'exclude_if:password,null', 'exclude_if:password,', 'confirmed', Password::defaults()],
            'is_active' => ['boolean']
        ]);

        // Mengambil semua data KECUALI role
        $userData = collect($validated)->except('role')->toArray();
        // Update Data User
        $user->update($userData);
        // Sync Role User
        $user->syncRoles($validated['role']);

        return redirect()->route('users.index')->with('success', 'Data pengguna baru berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // 1. Cek apakah user yang akan dihapus adalah user yang sedang login
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'Anda tidak diizinkan menghapus akun Anda sendiri!');
        }

        // 2. Jalankan proses hapus jika lolos pengecekan
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Data Pengguna berhasil dihapus');
    }
}
