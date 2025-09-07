<?php

namespace App\Http\Controllers;

use App\Models\Backcheck;
use App\Models\Branch;
use App\Models\Cluster;
use App\Models\KotaKabupaten;
use App\Models\Kecamatan;
use App\Models\Kompetitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InternalBackcheckController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $branch = Branch::with('clusters.kotaKabupaten.kecamatan')
            ->where('id', $user->branch_id)
            ->first();

        return view('backcheck.backcheck', [
            'branch' => $branch,
            'userClusterId' => $user->cluster_id,
            'competitors' => Kompetitor::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branch,id',
            'cluster_id' => 'required|exists:cluster,id',
            'kota_kabupaten_id' => 'required|exists:kota_kabupaten,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'outlet_id' => 'required|numeric',
            'outlet_name' => 'required|string|max:255',
            'owner_phone' => 'required|string|max:20',

            'display_share' => 'required|array',
            'sales_share_perdana' => 'required|array',
            'sales_share_renewal' => 'required|array',

            'photo_laporan' => 'nullable|image|max:2048',
            'photo_branding' => 'nullable|image|max:2048',
            'photo_display.*' => 'nullable|image|max:2048',

            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Normalize competitor shares
        $validated['display_share'] = array_map(fn($v) => $v === null || $v === '' ? 0 : (int) $v, $validated['display_share']);
        $validated['sales_share_perdana'] = array_map(fn($v) => $v === null || $v === '' ? 0 : (int) $v, $validated['sales_share_perdana']);
        $validated['sales_share_renewal'] = array_map(fn($v) => $v === null || $v === '' ? 0 : (int) $v, $validated['sales_share_renewal']);

        // Save photos gracefully with try/catch
        try {
            if ($request->hasFile('photo_laporan')) {
                $file = $request->file('photo_laporan');
                Log::info("Received photo_laporan", [
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime' => $file->getMimeType()
                ]);

                $validated['laporan_path'] = $file->store('backcheck_laporan', 'public');
            } else {
                Log::info("No photo_laporan received.");
            }
        } catch (\Throwable $e) {
            Log::error("Photo laporan upload failed: " . $e->getMessage());
        }

        try {
            if ($request->hasFile('photo_branding')) {
                $file = $request->file('photo_branding');
                Log::info("Received photo_branding", [
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime' => $file->getMimeType()
                ]);

                $validated['branding_path'] = $file->store('backcheck_branding', 'public');
            } else {
                Log::info("No photo_branding received.");
            }
        } catch (\Throwable $e) {
            Log::error("Photo branding upload failed: " . $e->getMessage());
        }

        try {
            if ($request->hasFile('photo_display')) {
                $paths = [];
                foreach ($request->file('photo_display') as $file) {
                    Log::info("Received photo_display file", [
                        'name' => $file->getClientOriginalName(),
                        'size' => $file->getSize(),
                        'mime' => $file->getMimeType()
                    ]);
                    $paths[] = $file->store('backcheck_display', 'public');
                }
                $validated['display_paths'] = $paths;
            } else {
                Log::info("No photo_display received.");
            }
        } catch (\Throwable $e) {
            Log::error("Photo display upload failed: " . $e->getMessage());
        }


        $validated['user_id'] = Auth::id();

        try {
            Backcheck::create($validated);
        } catch (\Throwable $e) {
            Log::error("Backcheck save failed: " . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while saving. Please try again.');
        }

        return redirect()->back()->with('success', 'Backcheck saved successfully!');
    }
}
