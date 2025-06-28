<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;
use App\Models\Setting;

class LaporanController extends Controller
{
    public function laporan(Request $request) {
        // Tangkap filter tanggal, default ke hari ini
        $tanggal_awal = $request->tanggal_awal ?? now()->startOfDay()->format('Y-m-d');
        $tanggal_akhir = $request->tanggal_akhir ?? now()->endOfDay()->format('Y-m-d');

        // Ambil data transaksi dalam rentang tanggal
        $query = Transaksi::with('user');

        if ($request->filled(['tanggal_awal', 'tanggal_akhir'])) {
            $tanggal_awal = $request->tanggal_awal;
            $tanggal_akhir = $request->tanggal_akhir;

            $query->whereBetween('created_at', [
                $tanggal_awal . ' 00:00:00',
                $tanggal_akhir . ' 23:59:59'
            ]);
        }

        $transaksi = $query->orderBy('created_at', 'asc')->get();

        // Hitung total
        $totalPendapatan = $transaksi->sum('bayar');
        $totalDiskon = $transaksi->sum('total_diskon');
        $totalDiterima = $transaksi->sum('diterima');
        $totalTransaksi = $transaksi->count();

        \Log::info('Tanggal Awal:', [$request->tanggal_awal]);
        \Log::info('Tanggal Akhir:', [$request->tanggal_akhir]);


        return view('Admin.pages.laporan.index', compact('transaksi', 'totalTransaksi', 'totalDiterima', 'totalDiskon', 'totalPendapatan', 'tanggal_awal', 'tanggal_akhir'));
    }

    public function cetakPDF(Request $request) {
        // Tangkap filter tanggal, default ke hari ini
        $tanggal_awal = $request->tanggal_awal ?? now()->startOfDay()->format('Y-m-d');
        $tanggal_akhir = $request->tanggal_akhir ?? now()->endOfDay()->format('Y-m-d');

        // Ambil data transaksi dalam rentang tanggal
        $query = Transaksi::with('user');

        if ($request->filled(['tanggal_awal', 'tanggal_akhir'])) {
            $tanggal_awal = $request->tanggal_awal;
            $tanggal_akhir = $request->tanggal_akhir;

            $query->whereBetween('created_at', [
                $tanggal_awal . ' 00:00:00',
                $tanggal_akhir . ' 23:59:59'
            ]);
        }

        $transaksi = $query->orderBy('created_at', 'asc')->get();
        $setting = Setting::first();

        // Hitung total
        $totalPendapatan = $transaksi->sum('total') - $transaksi->sum('total_diskon');
        $totalDiskon = $transaksi->sum('total_diskon');
        $totalDiterima = $transaksi->sum('diterima');
        $totalTransaksi = $transaksi->count();

        $pdf = PDF::loadView('Admin.pages.laporan.cetakpdf', compact('transaksi', 'totalTransaksi', 'totalDiterima', 'totalDiskon', 'totalPendapatan', 'tanggal_awal', 'tanggal_akhir', 'setting'))->setPaper('A4', 'portrait');
    
        return $pdf->stream('laporan-transaksi.pdf');
    }

    public function exportExcel(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);
    
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        return Excel::download(new TransaksiExport, 'Laporan-Transaksi.xlsx');
    }
}
