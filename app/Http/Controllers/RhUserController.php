<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RhUserController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        $colaboradores = User::where('role', 'rh')->get();


        return view('colaborators.rh-users', compact('colaboradores'));
    }

    public function newColaborator()
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        // get alll departments
        $departments = Department::all();

        return view('colaborators.add-rh-user', compact('departments'));

    }
}


