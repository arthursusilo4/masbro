<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionJabatan;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if (!Auth::check()) {
        return redirect('/login');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $roleId = Auth::user()->role_id;

        switch ($roleId) {
            case 1:
                $sessionId = session()->getId();

                $active = SessionJabatan::where('user_id', $user->id)
                    ->where('session_id', $sessionId)
                    ->first();

                if ($active) {
                    return view('homepage', [
                        'user' => $user,
                        'jabatan' => $active->jabatan,
                    ]);
                }

                return redirect()->route('post-login.show');
            case 2:
                return view('branchpage'); // resources/views/branchpage.blade.php
            case 3:
                return view('regionalpage'); // resources/views/regionalpage.blade.php
            default:
                return redirect('/login');
        }
    }
}
