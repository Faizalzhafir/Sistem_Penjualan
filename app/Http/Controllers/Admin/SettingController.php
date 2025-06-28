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
        $setting = Setting::first();
        return view('Admin.pages.setting.create', compact('setting'));
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

           $setting = Setting::first();
           
           $item = [
            'nama_toko'=>$request->nama_toko,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'email'=>$request->email,
            'logo'=>$request->logo,
           ];
           // Cek dan simpan logo baru jika ada
            if ($request->hasFile('logo')) {
                // Hapus logo lama jika ada
                if ($setting && $setting->logo && Storage::disk('public')->exists($setting->logo)) {
                    Storage::disk('public')->delete($setting->logo);
                }
                // Simpan logo baru
                $item['logo'] = $request->file('logo')->store('logo', 'public');
            }
            if($setting) {
                $setting->update($item);
            }else {
                Setting::create($item);
            }
          if ($item) {
            // Berhasil menyimpan data
            return redirect()->back()->with('success', 'Setting Berhasil Di Simpan');
        } else {
            // Gagal menyimpan data
            return redirect()->back()->with('error', 'Gagal');
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
