<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColaboratorsController extends Controller
{
    public function index(): View
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        $colaborators = User::withTrashed()
            ->with('detail', 'department')
            ->where('role', '<>', 'admin')
            ->get();

        return view('colaborators.admin-all-colaborators')->with('colaborators', $colaborators);
    }

    public function showDetails($id)
    {
        Auth::user()->can('admin', 'rh') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        // check if is the same as the auth user
        if (Auth::user()->id === $id) {
            return redirect()->route('home');
        }

        $colaborator = User::with('detail', 'department')
            ->where('id', $id)
            ->first();

        // check if colaborator exists
        if (!$colaborator) {
            abort(404);
        }

        return view('colaborators.show-details')->with('colaborator', $colaborator);
    }

    public function deleteColaborator($id)
    {
        Auth::user()->can('admin', 'rh') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        // check if is the same as the auth user
        if (Auth::user()->id === $id) {
            return redirect()->route('home');
        }

        $colaborator = User::findOrFail($id);

        return view('colaborators.delete-colaborator-confirm')->with('colaborator', $colaborator);
    }

    public function deleteColaboratorConfirm($id)
    {
        Auth::user()->can('admin', 'rh') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        // check if is the same as the auth user
        if (Auth::user()->id === $id) {
            return redirect()->route('home');
        }

        $colaborator = User::findOrFail($id);

        $colaborator->delete();

        return redirect()->route('colaborators.all-colaborators')->with('success', 'Colaborador deletado com sucesso');
    }

    public function restoreColaborator($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        $colaborator = User::withTrashed()->findOrFail($id);
        $colaborator->restore();

        return redirect()->route('colaborators.all-colaborators')->with('success', 'Colaborador restaurado com sucesso');
    }

    public function home(): View
    {
        Auth::user()->can('colaborator') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        // get colaborator data
        $colaborator = User::with('detail', 'department')
                        ->where('id', Auth::user()->id)
                        ->first();

        return view('colaborators.show-details', compact('colaborator'));
    }
}
