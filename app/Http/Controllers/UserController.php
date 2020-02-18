<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Lista todos los usuarios
    public function list()
    {
        // Se obtienen los usuarios
        $users = User::all();
        $title = __('back.userList');
        return view('users.list', compact('title', 'users'));
    }

    // Detalle de un usuario
    public function detail($pk)
    {
        // Se obtiene el usuario especifico o devuelve un 404 si no lo encuentra
        $user = User::findOrFail($pk);
        $title = __('back.userDetail');
        return view('users.detail', compact('title', 'user'));
    }
}