<?php

use App\Models\Department;
use App\Models\User;

it('Tests if an admin can insert a new RH user', function () {

    // criar user admin
    addAdmimUser();

    // criar os departamentos 
    addDepartment('Administração');
    addDepartment('Recursos Humanos');

    // login com admin
    $result = $this->post('/login', [
        "email" => 'admin@rhmangnt.com',
        "password" => 'Aa123456',
    ]);

    // verifica se o login foi feito com sucesso
    expect($result->status())->toBe(302);
    expect($result->assertRedirect('/home'));

    // verifica se o admim consegue adicionar user de rh
    $result = $this->post('/rh-users/create-colaborator', [
        'name' => 'RH USER 1',
        'email' => 'rhuser@gmail.com',
        'select_department' => 2,
        'address' => 'Rua 1',
        'zip_code' => '73050166',
        'city' => 'Brasília',
        'phone' => '981027519',
        'salary' => '10000.00',
        'admission_date' => '2021-01-10',
        'role' => 'rh',
        'permissions' => '["rh"]',
    ]);

    // verifica se o user de rh foi inserido com sucesso
    $this->assertDatabaseHas('users', [
        'name' => 'RH USER 1',
        'email' => 'rhuser@gmail.com',
        'role' => 'rh',
        'permissions' => '["rh"]',
    ]);
});


it('Tests if an RH user can insert a new collaborator user', function () {

    // criar user rh
    addRhUser();

    // criar os departamentos 
    addDepartment('Administração');
    addDepartment('Recursos Humanos');
    addDepartment('Armazém');

    // login com rh
    $this->post('/login', [
        "email" => 'rh1@rhmangnt.com',
        "password" => 'Aa123456',
    ]);

    // verifica se o login foi feito com sucesso
    expect(auth()->user()->role)->toBe('rh');

    // verifica se o user RH consegue adicionar um colaborador
    $result = $this->post('/rh-users/management/create-colaborator', [
        'name' => 'Collaborator 1',
        'email' => 'collaborator1@gmail.com',
        'select_department' => 3,
        'address' => 'Rua 1',
        'zip_code' => '73050166',
        'city' => 'Brasília',
        'phone' => '981027519',
        'salary' => '10000.00',
        'admission_date' => '2021-01-10',
        'role' => 'colaborator',
        'permissions' => '["colaborator"]',
    ]);

    // verifica se o user colaborador foi inserido com sucesso
    // php unit
    // $this->assertDatabaseHas('users', [
    //     'name' => 'Collaborator 1',
    //     'email' => 'collaborator1@gmail.com',
    //     'role' => 'colaborator',
    //     'permissions' => '["colaborator"]',
    // ]);

    // outro jeito de testar usando o pest
    expect(User::where('email', 'collaborator1@gmail.com')->exists())->toBeTrue();


});

function addDepartment($name)
{
    Department::insert([
        'name' => $name,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}
