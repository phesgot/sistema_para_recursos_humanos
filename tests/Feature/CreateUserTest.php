<?php

use App\Models\Department;

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

function addDepartment($name)
{
    Department::insert([
        'name' => $name,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}
