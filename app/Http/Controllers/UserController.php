<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Solo admins
        if (!auth()->user()->admin) {
            abort(403);
        }

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function toggleSubscription(User $user)
{
    if (!auth()->user()->admin) {
        abort(403);
    }

    // Cambiar estado de suscripción
    $user->subscriber = !$user->subscriber;

    // Si se desactiva la suscripción, limpiar la fecha de fin
    if (!$user->subscriber) {
        $user->subscription_ends_at = null;
    }

    $user->save();

    return back()->with('success', 'Estado de suscripción actualizado.');
}


    public function destroy(User $user)
    {
        if (!auth()->user()->admin) {
            abort(403);
        }

        $user->delete();

        return back()->with('success', 'Usuario eliminado correctamente.');
    }

    public function toggleAdmin(User $user)
{
    if (!auth()->user()->admin) {
        abort(403);
    }

    // Protege al superadmin (puedes usar también ID: $user->id === 1)
    if ($user->email === 'admin@easyenglish.com') {
        return back()->with('error', 'No puedes modificar al superadministrador.');
    }

    $user->admin = !$user->admin;
    $user->save();

    return back()->with('success', 'Rol de administrador actualizado.');
}

}
