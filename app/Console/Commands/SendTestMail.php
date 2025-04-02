<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestMail extends Command
{
    protected $signature = 'mail:send-test';
    protected $description = 'Envía un correo de prueba para verificar la configuración SMTP';

    public function handle()
    {
        try {
            Mail::raw('Este es un correo de prueba desde EasyEnglish.', function ($message) {
                $message->to('robertoramirezmoreno@gmail.com')
                        ->subject('📧 Test de correo desde EasyEnglish');
            });

            $this->info('✅ Correo de prueba enviado con éxito.');
        } catch (\Exception $e) {
            $this->error('❌ Error al enviar el correo: ' . $e->getMessage());
        }
    }
}
