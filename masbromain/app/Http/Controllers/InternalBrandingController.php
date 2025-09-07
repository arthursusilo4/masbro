<?php

namespace App\Http\Controllers;

use App\Models\Branding;
use App\Models\Branch;
use App\Models\JenisBranding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternalBrandingController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $branch = Branch::with('clusters.kotaKabupaten.kecamatan')
            ->where('id', $user->branch_id)
            ->first();

        return view('branding.branding', [
            'branch' => $branch,
            'userClusterId' => $user->cluster_id,
            'jenisBranding' => JenisBranding::all()
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'branch_id' => 'required|exists:branch,id',
            'cluster_id' => 'required|exists:cluster,id',
            'kota_kabupaten_id' => 'required|exists:kota_kabupaten,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'outlet_id' => 'required|numeric',
            'outlet_name' => 'required|string|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
            'jenis_branding' => 'required|array',
            'jenis_branding.*' => 'exists:jenis_branding,id',
        ];

        foreach ($request->jenis_branding as $jbId) {
            if ($request->hasFile("photos.$jbId")) {
                $rules["photos.$jbId"] = 'image|max:2048'; // only check if uploaded
            }
        }

        $validated = $request->validate($rules);


        $branding = Branding::create([
            'user_id' => Auth::id(),
            'branch_id' => $request->branch_id,
            'cluster_id' => $request->cluster_id,
            'kota_kabupaten_id' => $request->kota_kabupaten_id,
            'kecamatan_id' => $request->kecamatan_id,
            'outlet_id' => $request->outlet_id,
            'outlet_name' => $request->outlet_name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        foreach ($request->jenis_branding as $jbId) {
            if ($request->hasFile("photos.$jbId")) {
                $path = $request->file("photos.$jbId")->store('branding_photos', 'public');
            } else {
                $path = null;
            }

            $branding->brandingDetail()->create([
                'jenis_branding_id' => $jbId,
                'photo' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Branding berhasil disimpan!');
    }
}
