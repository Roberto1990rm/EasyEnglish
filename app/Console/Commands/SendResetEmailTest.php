<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class SendResetEmailTest extends Command
{
    protected $signature = 'test:reset-email {email}';

    protected $description = 'Envía un email de recuperación de contraseña a una dirección específica';

    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("❌ No se encontró el usuario con ese email.");
            return Command::FAILURE;
        }

        $status = Password::sendResetLink(['email' => $email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->info("✅ Enlace de recuperación enviado correctamente a $email");
            return Command::SUCCESS;
        }

        $this->error("⚠️ Error al enviar el enlace: $status");
        return Command::FAILURE;
    }
}
