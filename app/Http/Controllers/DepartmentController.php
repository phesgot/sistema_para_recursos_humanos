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

    public function editDepartment($id) 
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        // Check if id === 1
        if(intval($id) === 1 ){
            return redirect()->route('departments');
        }
        $department = Department::findOrFail($id);

        return view('department.edit-department', compact('department'));
    }

    public function updateDepartment(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        $id = $request->id;

        $request->validate([
            'id' => 'required',
            'name' => 'required|string|min:3|max:50|unique:departments,name,' . $id
        ]); 

        // check if id === 1
        // Check if id === 1
        if(intval($id) === 1 ){
            return redirect()->route('departments');
        }

        $department = Department::findOrFail($id);

        $department->update([
            'name' => $request->name
        ]);

        return redirect()->route('departments');



    }

    public function deleteDepartment($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        // Check if id === 1
        if(intval($id) === 1 ){
            return redirect()->route('departments');
        }

        $department = Department::findOrFail($id);

        // Display page for confirmation
        return view('department.delete-department', compact('department'));
    }

    public function deleteDepartmentConfirm($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        // Check if id === 1
        if(intval($id) === 1 ){
            return redirect()->route('departments');
        }

        $department = Department::findOrFail($id);

        $department->delete();

        return redirect()->route('departments');

    }
}
