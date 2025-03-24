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

        $user->subscriber = !$user->subscriber;
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
}
