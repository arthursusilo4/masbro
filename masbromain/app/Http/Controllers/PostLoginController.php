<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\SessionJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLoginController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $jabatans = Jabatan::where('role_id', 1)->get();

        return view('post-login', [
            'user' => $user,
            'jabatans' => $jabatans,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan_id' => 'required|exists:jabatan,id',
        ]);

        $user = Auth::user();
        $sessionId = session()->getId();

        // Save temporary jabatan
        SessionJabatan::create([
            'user_id' => $user->id,
            'session_id' => $sessionId,
            'jabatan_id' => $request->jabatan_id,
        ]);

        return redirect()->route('user.home');
    }
}
