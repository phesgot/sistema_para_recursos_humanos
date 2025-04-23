<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmAccountEmail;
use App\Models\Department;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RhManagementController extends Controller
{
    public function home(): View
    {
        Auth::user()->can('rh') ?: abort(403, 'Você não tem autorização para acessar esta página');

        // get all colaborators that are not role admin nor role rh
        $colaborators = User::with('detail', 'department')
            ->where('role', 'colaborator')
            ->withTrashed()
            ->get();

        return view('colaborators.colaborators', compact('colaborators'));
    }

    public function newColaborator(): View
    {
        Auth::user()->can('rh') ?: abort(403, 'Você não tem autorização para acessar esta página');

        $departments = Department::where('id', '>', 2)->get();

        // if there are no departments, abort the request
        if($departments->count() === 0){
            abort(403, 'Não há departamento para adicionar um novo colaborador. Por-favor contacte o administrador do sistemas para adicionar novos departamentos.');
        }

        return view('colaborators.add-colaborator', compact('departments'));

    }

    public function createColaborator(Request $request)
    {
        Auth::user()->can('rh') ?: abort(403, 'Você não tem permissão para acessar esta página.');

        // form validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'select_department' => 'required|exists:departments,id',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:25',
            'salary' => 'required|decimal:2',
            'admission_date' => 'required|date_format:Y-m-d'
        ]);

        // check if department id == 2
        if ($request->select_department <= 2) {
            return redirect()->route('home');
        }

        // create user conformation token
        $token = Str::random(60);

        // create new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->confirmation_token = $token;
        $user->role = 'colaborator';
        $user->department_id = $request->select_department;
        $user->permissions = '["colaborator"]';
        $user->save();

        // save user details
        $user->detail()->create([
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'phone' => $request->phone,
            'salary' => $request->salary,
            'admission_date' => $request->admission_date,
        ]);

        // send email to user
        Mail::to($user->email)->send(new ConfirmAccountEmail(route('confirm-account', $token)));

        return redirect()->route('rh.management.home')->with('success', 'Colaborador criado com sucesso');
    }
}

