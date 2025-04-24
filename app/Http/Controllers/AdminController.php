<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home(): View
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        // colleact all information about the organization
        $data = [];

        // get total number of colaborators (deletes_at is null)
        $data['total_colaborators'] = User::whereNull('deleted_at')->count();

        // total colaborators deleted
        $data['total_colaborators_deleted'] = User::onlyTrashed()->count();

        // total salary for all colaborators
        $data['total_salary'] = User::withoutTrashed()
            ->with('detail')
            ->get()->sum(function ($colaborator) {
                return $colaborator->detail->salary;
            });

            $data['total_salary'] = 'R$ ' . number_format($data['total_salary'], 2, ',', '.');

        // total colaborators by department
        $data['total_colaborators_per_department'] = User::withoutTrashed()
            ->with('department')
            ->get()
            ->groupBy('department_id')
            ->map(function ($department) {
                return [
                    'department' => $department->first()->department->name ?? "-",
                    'total' =>  $department->count()
                ];
            });

        // total salary by department
        $data['total_salary_by_department'] = User::withoutTrashed()
            ->with('department', 'detail')
            ->get()
            ->groupBy('department_id')
            ->map(function ($department) {
                return [
                    'department' => $department->first()->department->name ?? "-",
                    'total' => $department->sum(function ($colaborator) {
                        return $colaborator->detail->salary;
                    })
                ];
            });

        // display admin home page
        return view('home', compact('data'));
    }
}
