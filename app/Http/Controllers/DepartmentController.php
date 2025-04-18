<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        $departments = Department::all();


        return view('department.departments', compact('departments'));
    }

    public function newDepartment(): View
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        return view('department.add-department');
    }

    public function creatDepartment(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        // form validation
        $request->validate(
            [
                'name' => 'required|string|max:50|unique:departments'
            ]
        );

        Department::create(
            [
                'name' => $request->name
            ]
        );

        return redirect()->route('departments');
    }
}
