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

    public function createRhColaborator(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        // form validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'select_department' => 'required|exists:departments,id',
        ]);

        // create new rh user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 'rh';
        $user->department_id = $request->select_department;
        $user->permissions = '["rh"]';
        $user->save();

        return redirect()->route('colaborators.rh-users')->with('success', 'Colaborador criado com sucesso');
    }
}


