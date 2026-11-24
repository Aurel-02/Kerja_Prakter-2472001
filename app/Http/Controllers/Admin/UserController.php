<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua akun pengguna
     */
    public function index()
    {
        $users = User::orderBy('role', 'asc')
            ->orderBy('nama', 'asc')
            ->get();

        $totalAdmin = $users->where('role', 'admin')->count();
        $totalGuru  = $users->where('role', 'guru')->count();
        $totalAktif = $users->where('status', 'aktif')->count();

        return view('admin.users', compact('users', 'totalAdmin', 'totalGuru', 'totalAktif'));
    }

    /**
     * Menyimpan akun pengguna baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'username' => 'required|string|max:100|alpha_dash|unique:user,username',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,guru',
            'status'   => 'required|in:aktif,nonaktif',
        ], [
            'nama.required'     => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique'   => 'Username ini sudah digunakan.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, tanda strip, dan underscore.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal harus 6 karakter.',
            'role.required'     => 'Role pengguna wajib dipilih.',
            'status.required'   => 'Status pengguna wajib dipilih.',
        ]);

        User::create([
            'nama'     => trim($validated['nama']),
            'username' => strtolower(trim($validated['username'])),
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
            'status'   => $validated['status'],
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'Akun pengguna "' . $validated['nama'] . '" berhasil dibuat.');
    }

    /**
     * Memperbarui data akun pengguna
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'username' => 'required|string|max:100|alpha_dash|unique:user,username,' . $id . ',id_user',
            'password' => 'nullable|string|min:6',
            'role'     => 'required|in:admin,guru',
            'status'   => 'required|in:aktif,nonaktif',
        ], [
            'nama.required'     => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique'   => 'Username ini sudah digunakan oleh akun lain.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, tanda strip, dan underscore.',
            'password.min'      => 'Password baru minimal harus 6 karakter.',
            'role.required'     => 'Role pengguna wajib dipilih.',
            'status.required'   => 'Status pengguna wajib dipilih.',
        ]);

        // Cegah admin mengunci diri sendiri
        if (Auth::id() == $user->id_user) {
            if ($validated['status'] === 'nonaktif') {
                return back()->with('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri yang sedang digunakan.');
            }
            if ($validated['role'] !== 'admin') {
                return back()->with('error', 'Anda tidak dapat mengubah role akun Anda sendiri menjadi non-admin.');
            }
        }

        $user->nama     = trim($validated['nama']);
        $user->username = strtolower(trim($validated['username']));
        $user->role     = $validated['role'];
        $user->status   = $validated['status'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users')
            ->with('success', 'Data akun pengguna "' . $user->nama . '" berhasil diperbarui.');
    }

    /**
     * Menghapus akun pengguna
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cegah menghapus akun yang sedang login
        if (Auth::id() == $user->id_user) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif digunakan.');
        }

        $nama = $user->nama;
        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'Akun pengguna "' . $nama . '" berhasil dihapus.');
    }
}
