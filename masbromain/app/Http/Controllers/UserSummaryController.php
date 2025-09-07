<?php

namespace App\Http\Controllers;

use App\Models\Backcheck;
use App\Models\Branding;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\Aktivitas;
use App\Models\Infokompetitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class UserSummaryController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user();

        // Get all jabatans (to show even if count = 0)
        $jabatans = Jabatan::all();

        $usersByJabatan = $jabatans->map(function ($jabatan) use ($currentUser) {
            return [
                'jabatan_id'   => $jabatan->id,
                'jabatan_name' => $jabatan->name,
                'backchecks'   => Backcheck::where('cluster_id', $currentUser->cluster_id)
                                    ->where('jabatan_id', $jabatan->id)
                                    ->count(),
                'brandings'    => Branding::where('cluster_id', $currentUser->cluster_id)
                                    ->where('jabatan_id', $jabatan->id)
                                    ->count(),
                'infokompetitors' => InfoKompetitor::where('cluster_id', $currentUser->cluster_id)
                                    ->where('jabatan_id', $jabatan->id)
                                    ->count(),
                'aktivitas'    => Aktivitas::where('cluster_id', $currentUser->cluster_id)
                                    ->where('jabatan_id', $jabatan->id)
                                    ->count(),
            ];
        });

        return view('summary.summary', [
            'usersByJabatan' => $usersByJabatan
        ]);
    }


    public function detail(Request $request, $userId)
    {
        $filter = $request->get('filter', 'today');
        $type = $request->get('type', 'all');

        // Date range based on filter
        $start = null;
        $end = now();

        switch ($filter) {
            case 'today':
                $start = Carbon::today();
                break;
            case 'week':
                $start = now()->startOfWeek();
                break;
            case 'month':
                $start = now()->startOfMonth();
                break;
            case 'custom':
                $start = $request->get('start_date');
                $end = $request->get('end_date');
                break;
        }

        $entries = collect();

        if ($type == 'all' || $type == 'backcheck'){
            $backcheck = Backcheck::with(['branch', 'cluster'])
            ->where('user_id', $userId)
            ->when($start, fn($q) => $q->whereBetween('created_at', [$start, $end]))
            ->get()
            ->map(fn($item) => [
                'type' => 'backcheck',
                'id' => $item->id,
                'branch' => $item->branch->name,
                'cluster' => $item->cluster->name,
                'outlet' => $item->outlet_name,
                'datetime' => $item->created_at,
                'raw' => $item
            ]);
            $entries = $entries->merge($backcheck);
        }

        if ($type == 'all' || $type == 'branding'){
            $branding = Branding::with(['branch', 'cluster', 'brandingDetail.jenisBranding'])
            ->where('user_id', $userId)
            ->when($start, fn($q) => $q->whereBetween('created_at', [$start, $end]))
            ->get()
            ->map(fn($item) => [
                'type' => 'branding',
                'id' => $item->id,
                'branch' => $item->branch->name,
                'cluster' => $item->cluster->name,
                'outlet' => $item->outlet_name,
                'datetime' => $item->created_at,
                'jenis_branding' => $item->brandingDetail->pluck('jenisBranding.name')->join(', '),
                'raw' => $item
            ]);
            $entries = $entries->merge($branding);
        }

        if ($type == 'all' || $type == 'infokompetitor'){
            $infokompetitor = Infokompetitor::with(['branch', 'cluster', 'kompetitor', 'promotion'])
            ->where('user_id', $userId)
            ->when($start, fn($q) => $q->whereBetween('created_at', [$start, $end]))
            ->get()
            ->map(fn($item) => [
                'type' => 'infokompetitor',
                'id' => $item->id,
                'branch' => $item->branch->name,
                'cluster' => $item->cluster->name,
                'outlet' => $item->outlet_name,
                'channel' => $item->channel,
                'kompetitor' => $item->kompetitor->name,
                'promosi' => $item->promotion->name,
                'datetime' => $item->created_at,
                'raw' => $item
            ]);
            $entries = $entries->merge($infokompetitor);
        }

       // Sort by datetime descending
        $entries = $entries->sortByDesc('datetime');

        $perPage = 4;
        $page = LengthAwarePaginator::resolveCurrentPage();
        $paginated = new LengthAwarePaginator(
            $entries->forPage($page, $perPage),
            $entries->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('summary.detail', [
            'entries' => $paginated,
            'filter' => $filter,
        ]);
    }
}
