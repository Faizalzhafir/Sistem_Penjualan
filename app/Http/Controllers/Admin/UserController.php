<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get(config('app.api_url') . '/api/user');
        $users = $response->successful() ? $response->json()['data'] : [];

        return view('admin.pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,kasir,user',
        ]);

        $response = Http::post(config('app.api_url') . '/api/user', $validated);

        if ($response->successful()) {
            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
        }

        return back()->with('error', 'Gagal tambah user: ' . $response->body());
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
    public function edit($id)
    {
        $response = Http::get(config('app.api_url') . "/api/user/{$id}");

        if ($response->successful()) {
            $user = $response->json()['data'];
            return view('admin.pages.user.edit', compact('user'));
        }

        return back()->with('error', 'User tidak ditemukan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'nullable|string|min:6',
            'role'     => 'required|in:admin,kasir,user',
        ]);

        $data = $validated;
        if (!$data['password']) unset($data['password']); // hapus kalau kosong

        $response = Http::put(config('app.api_url') . "/api/user/{$id}", $data);

        if ($response->successful()) {
            return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
        }

        return back()->with('error', 'Gagal update: ' . $response->body());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = Http::delete(config('app.api_url') . "/api/user/{$id}");

        if ($response->successful()) {
            return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
        }

        return back()->with('error', 'Gagal hapus user.');
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,aktif,tolak',
        ]);

        $response = Http::patch(config('app.api_url') . "/api/user/{$id}/status", $validated);

        return $response->successful()
            ? back()->with('success', 'Status user berhasil diubah')
            : back()->with('error', 'Gagal ubah status');
    }
}
