<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(ContactRequest $request)
    {
        $validated = $request->validated();

        Mail::to(config('mail.from.address'))
            ->send(new ContactMail($validated));

        return redirect()
            ->route('products.index')
            ->with('success', 'お問い合わせを送信しました。');
    }
}