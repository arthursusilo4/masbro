<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\JenisAktivitas;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternalAktivitasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $branch = Branch::with('clusters.kotaKabupaten.kecamatan')
            ->where('id', $user->branch_id)
            ->first();

        return view('activity.activity', [
            'branch' => $branch,
            'userClusterId' => $user->cluster_id,
            'jenisActivities' => JenisAktivitas::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'cluster_id' => 'required',
            'kota_kabupaten_id' => 'required',
            'kecamatan_id' => 'required',
            'jenis_activity_id' => 'required',
            'activity_name' => 'required|string',
            'activity_detail' => 'nullable|string',
        ]);

        Aktivitas::create([
            'user_id' => Auth::id(),
            'branch_id' => $request->branch_id,
            'cluster_id' => $request->cluster_id,
            'kota_kabupaten_id' => $request->kota_kabupaten_id,
            'kecamatan_id' => $request->kecamatan_id,
            'jenis_activity_id' => $request->jenis_activity_id,
            'activity_name' => $request->activity_name,
            'activity_detail' => $request->activity_detail,
        ]);

        return back()->with('success', '✅ Activity berhasil disimpan!');
    }
}
