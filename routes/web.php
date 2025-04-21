<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RhUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::redirect('/', 'home');
    Route::view('/home', 'home')->name('home');

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
    Route::get('/rh-users/new-colaborator', [RhUserController::class, 'newColaborator'])->name('colaborators.new-colaborator');
    Route::post('/rh-users/create-colaborator', [RhUserController::class, 'createRhColaborator'])->name('colaborators.create-colaborator');

    Route::get('/rh-users/edit-colaborator/{id}', [RhUserController::class, 'editRhColaborator'])->name('colaborators.edit-colaborator');
    Route::post('/rh-users/update-colaborator', [RhUserController::class, 'updateRhColaborator'])->name('colaborators.update-colaborator');
});


