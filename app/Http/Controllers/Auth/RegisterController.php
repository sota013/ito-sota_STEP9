<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_kanji' => ['required', 'string', 'max:255'],
            'name_kana' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'name_kanji' => $validated['name_kanji'],
            'name_kana' => $validated['name_kana'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'company_id' => 1,
        ]);

        return redirect()->route('login')
            ->with('success', '会員登録が完了しました。');
    }
}