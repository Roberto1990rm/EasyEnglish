<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Enviar el correo
        Mail::send('emails.contact', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'messageContent' => $validated['message'],
        ], function ($message) use ($validated) {
            $message->to('robertoramirezmoreno@gmail.com')
                    ->subject('Nuevo mensaje de contacto desde EasyEnglish');
        });

        return back()->with('success', 'Tu mensaje ha sido enviado con éxito.');
    }

    // También podés tener este método si usás una vista de contacto:
    public function show()
    {
        return view('contact');
    }
}
