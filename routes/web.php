<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColaboratorsController;
use App\Http\Controllers\ConfirmAccountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RhManagementController;
use App\Http\Controllers\RhUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // email confirmation and password definition
    Route::get('/confirm-account/{token}', [ConfirmAccountController::class, 'confirmAccount'])->name('confirm-account');
    Route::post('/confirm-account', [ConfirmAccountController::class, 'confirmAccountSubmit'])->name('confirm-account-submit');
});

Route::middleware('auth')->group(function () {
    Route::redirect('/', 'home');
    Route::get('/home', function(){

        // check if user is admin 
        if(auth()->user()->role === 'admin'){
            return redirect()->route('admin.home');
        } elseif(auth()->user()->role === 'rh'){
            return redirect()->route('rh.management.home');
        } else{
            die('vai para a página inicial do colaborador normal');
        }
    })->name('home');

    // User profile page
    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/user/profile/update-password', [ProfileController::class, 'updatePassword'])->name('user.profile.update-password');
    Route::post('/user/profile/update-user-data', [ProfileController::class, 'updateUserData'])->name('user.profile.update-user-data');

    // Department route
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    Route::get('/departments/new-department', [DepartmentController::class, 'newDepartment'])->name('department.new-department');
    Route::post('/departments/creat-department', [DepartmentController::class, 'creatDepartment'])->name('department.creat-department');
    Route::get('/departments/edit-department/{id}', [DepartmentController::class, 'editDepartment'])->name('department.edit-department');
    Route::post('/departments/update-department', [DepartmentController::class, 'updateDepartment'])->name('department.update-department');
    Route::get('/departments/delete-department/{id}', [DepartmentController::class, 'deleteDepartment'])->name('department.delete-department');
    Route::get('/departments/delete-department-confirm/{id}', [DepartmentController::class, 'deleteDepartmentConfirm'])->name('department.delete-department-confirm');

    // RH colaborador routes
    Route::get('/rh-users', [RhUserController::class, 'index'])->name('colaborators.rh-users');
    Route::get('/rh-users/new-colaborator', [RhUserController::class, 'newColaborator'])->name('colaborators.rh.new-colaborator');
    Route::post('/rh-users/create-colaborator', [RhUserController::class, 'createRhColaborator'])->name('colaborators.rh.create-colaborator');
    Route::get('/rh-users/edit-colaborator/{id}', [RhUserController::class, 'editRhColaborator'])->name('colaborators.rh.edit-colaborator');
    Route::post('/rh-users/update-colaborator', [RhUserController::class, 'updateRhColaborator'])->name('colaborators.rh.update-colaborator');
    Route::get('/rh-users/delete-colaborator/{id}', [RhUserController::class, 'deleteRhColaborator'])->name('colaborators.rh.delete');
    Route::get('/rh-users/delete-colaborator-confirm/{id}', [RhUserController::class, 'deleteRhColaboratorConfirm'])->name('colaborators.rh.delete-confirm');
    Route::get('/rh-users/restore/{id}', [RhUserController::class, 'restoreRhColaboratorConfirm'])->name('colaborators.rh.restore');

    Route::get('/rh-users/management/home', [RhManagementController::class, 'home'])->name('rh.management.home');
    Route::get('/rh-users/management/new-colaborator', [RhManagementController::class, 'newColaborator'])->name('rh.management.new-colaborator');
    Route::post('/rh-users/management/create-colaborator', [RhManagementController::class, 'createColaborator'])->name('rh.management.create-colaborator');
    Route::get('/rh-users/management/edit-colaborator/{id}', [RhManagementController::class, 'editColaborator'])->name('rh.management.edit-colaborator');
    Route::post('/rh-users/management/update-colaborator/', [RhManagementController::class, 'updateColaborator'])->name('rh.management.update-colaborator');
    Route::get('/rh-users/management/details/{id}', [RhManagementController::class, 'showDetails'])->name('rh.management.details-colaborator');

    // admin colaborators list
    Route::get('/colaborators', [ColaboratorsController::class, 'index'])->name('colaborators.all-colaborators');
    Route::get('/colaborators/details/{id}', [ColaboratorsController::class, 'showDetails'])->name('colaborators.details');
    Route::get('/colaborators/delete/{id}', [ColaboratorsController::class, 'deleteColaborator'])->name('colaborators.delete');
    Route::get('/colaborators/delete-confirm/{id}', [ColaboratorsController::class, 'deleteColaboratorConfirm'])->name('colaborators.delete-confirm');
    Route::get('/colaborators/restore/{id}', [ColaboratorsController::class, 'restoreColaboratorConfirm'])->name('colaborators.restore');

    // admin routes
    Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
});
