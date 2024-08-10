<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        // 1. Mengapa $request perlu di-injeksi sebagai parameter dalam method updateProfile?
        // $request di-injeksi sebagai parameter untuk mengakses data yang dikirimkan oleh pengguna melalui HTTP request.
        // Ini termasuk data yang dikirim melalui form, query parameters, atau input lainnya.
        // Dengan menggunakan $request, kita bisa mengakses input yang dikirim pengguna, seperti 'name' dan 'email', dan memprosesnya dalam method ini.

        $user = auth()->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        // 2. Apakah ada fitur keamanan yang perlu ditambahkan ke dalam method updateProfile?
        // Ya, sebaiknya tambahkan fitur validasi untuk memastikan data yang diterima dari pengguna adalah valid.
        // Selain itu, perlu dilakukan validasi keamanan tambahan untuk mencegah serangan seperti Mass Assignment.
        // Gunakan $request->validate() untuk melakukan validasi, dan pastikan model User memiliki fillable properties yang tepat.

        // Contoh implementasi validasi:
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        // ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
