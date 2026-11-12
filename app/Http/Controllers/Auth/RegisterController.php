<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();

        User::registerUser([
            'name' => $validated['name'],
            'name_kanji' => $validated['name_kanji'],
            'name_kana' => $validated['name_kana'] ?? null,
            'email' => $validated['email'],
            'password' => $validated['password'],
            'company_id' => 1,
        ]);

        return redirect()->route('login')
            ->with('success', '会員登録が完了しました。');
    }
}
