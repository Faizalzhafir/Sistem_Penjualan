<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
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
        return view('Admin.pages.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required',
            'logo' => 'image|file|max:2048',
           ]); 
           
           $item = [
            'nama_toko'=>$request->nama_toko,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'email'=>$request->email,
            'logo'=>$request->logo,
           ];
           if($request->file('logo')) {
            $item['logo'] = $request->file('logo')->store('logo');
           }
           Setting::create($item);
          if ($item) {
            // Berhasil menyimpan data
            return redirect()->back()->with('success', 'Kursus Berhasil Di Tambahkan');
        } else {
            // Gagal menyimpan data
            return redirect()->back()->with('error', 'Failed to create new record');
        }
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
        $setting = Setting::find($id);
        return view('setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_toko' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
            'logo' => 'nullable|image|file|max:2048',
        ]); 
    
        $setting = Setting::findOrFail($id);
    
        $item = [
            'nama_toko' => $request->nama_toko,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,
        ];
    
        // Cek dan simpan logo baru jika ada
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($setting->logo && Storage::exists($setting->logo)) {
                \Storage::delete($setting->logo);
            }
    
            // Simpan logo baru
            $item['logo'] = $request->file('logo')->store('logo');
        }
    
        $updated = $setting->update($item);
    
        if ($updated) {
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        }
    
        return redirect()->back()->with('error', 'Data gagal disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
