<?php

namespace App\Http\Controllers;

use App\Models\InfoKompetitor;
use App\Models\Branch;
use App\Models\JenisPromosi;
use App\Models\Kompetitor;
use App\Models\SessionJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoKompetitorController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $branch = Branch::with('clusters.kotaKabupaten.kecamatan')
            ->where('id', $user->branch_id)
            ->first();

        return view('infokompetitor.infokompetitor', [
            'branch' => $branch,
            'userClusterId' => $user->cluster_id,
            'kompetitors'   => Kompetitor::all(),
            'promos'        => JenisPromosi::orderBy('id')->get(), // has 9; UI will show 1–6
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'branch_id'          => 'required|exists:branch,id',
            'cluster_id'         => 'required|exists:cluster,id',
            'kota_kabupaten_id'  => 'required|exists:kota_kabupaten,id',
            'kecamatan_id'       => 'required|exists:kecamatan,id',
            'channel'            => 'required|in:outlet,non_outlet',
            'kompetitor_id'      => 'required|exists:kompetitor,id',
            'promotion_ids'      => 'required|array|min:1',
            'promotion_ids.*'    => 'exists:jenis_promosi,id',
            'latitude'           => 'required',
            'longitude'          => 'required',
        ];

        if ($request->channel === 'outlet') {
            $rules['outlet_id']   = 'required|numeric';
            $rules['outlet_name'] = 'required|string|max:255';
        } else {
            $rules['outlet_id']   = 'nullable';
            $rules['outlet_name'] = 'nullable';
        }

        // validate dynamic promo photos
        foreach ($request->promotion_ids as $promoId) {
            if ($request->hasFile("promo_photos.$promoId")) {
                $rules["promo_photos.$promoId"] = 'image|max:4096';
            }
        }

        $validated = $request->validate($rules);

        $sessionId = session()->getId();
        $activeJabatan = SessionJabatan::where('user_id', Auth::id())
            ->where('session_id', $sessionId)
            ->first();

        // loop over promos and create entry per promo
        foreach ($request->promotion_ids as $promoId) {
            $path = null;
            if ($request->hasFile("promo_photos.$promoId")) {
                $path = $request->file("promo_photos.$promoId")
                                ->store('infokompetitor_photos', 'public');
            }

            InfoKompetitor::create([
                'user_id'           => Auth::id(),
                'jabatan_id'        => $activeJabatan ? $activeJabatan->jabatan_id : null,
                'branch_id'         => $request->branch_id,
                'cluster_id'        => $request->cluster_id,
                'kota_kabupaten_id' => $request->kota_kabupaten_id,
                'kecamatan_id'      => $request->kecamatan_id,
                'channel'           => $request->channel,
                'outlet_id'         => $request->channel === 'outlet' ? $request->outlet_id : null,
                'outlet_name'       => $request->channel === 'outlet' ? $request->outlet_name : null,
                'kompetitor_id'     => $request->kompetitor_id,
                'promotion_id'      => $promoId,
                'photo'             => $path,
                'latitude'          => $request->latitude,
                'longitude'         => $request->longitude,
            ]);
        }

        return redirect('/post-submit');
    }

}
