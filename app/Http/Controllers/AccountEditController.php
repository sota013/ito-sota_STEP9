<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountRequest;

class AccountEditController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('account.edit', compact('user'));
    }

    public function update(UpdateAccountRequest $request)
    {
        $user = auth()->user();

        $validated = $request->validated();

        $user->updateAccount($validated);

        return redirect()->route('mypage')
            ->with('success', 'アカウント情報を更新しました。');
    }
}
