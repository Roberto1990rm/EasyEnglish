<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestEmail extends Command
{
    protected $signature = 'mail:send-test';
    protected $description = 'Enviar un correo de prueba';

    public function handle()
    {
        Mail::raw('Este es un email de prueba desde EasyEnglish.', function ($message) {
            $message->to('robertoramirezmoreno@gmail.com')
                    ->subject('Correo de prueba');
        });

        $this->info('📨 Correo enviado correctamente (si la configuración SMTP es válida).');
    }
}
