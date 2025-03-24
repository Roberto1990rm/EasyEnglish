<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            // Guardar nueva
            $path = $request->file('image')->store('images/users', 'public');
            $user->image = $path;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function deleteImage()
    {
        $user = auth()->user();
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
            $user->image = null;
            $user->save();
        }

        return back()->with('success', 'Imagen eliminada.');
    }
}
