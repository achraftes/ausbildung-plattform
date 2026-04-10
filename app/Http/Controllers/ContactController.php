<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'vorname'   => 'required|string|max:100',
            'nachname'  => 'required|string|max:100',
            'email'     => 'required|email',
            'betreff'   => 'required|string',
            'nachricht' => 'required|string|min:10',
        ]);

        // Mail::to('kontakt@careerhub.de')->send(new \App\Mail\ContactMail($request->all()));

        return redirect()->route('contact')
                         ->with('success', 'Nachricht erfolgreich gesendet!');
    }
}
