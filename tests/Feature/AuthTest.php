<?php

use App\Models\User;

it('display the login page when not logged in', function () {

    // verifica, no contexto do Fortify, se ao entrar na página inicial, vai ser
    // redirecionado para a página de login.
    $result = $this->get('/')->assertRedirect('/login');

    // verifica se o resultado é o 302
    expect($result->status())->toBe(302);

    // verifica se a rota de login é acessivel com status 200
    expect($this->get('/login')->status())->toBe(200);

    // verifica se a página de login contém o texto "Esqueceu a sua senha?"
    expect($this->get('/login')->content())->toContain("Esqueceu a sua senha?");
});

it('Display the recover password page correctly', function () {
    expect($this->get('/forgot-password')->status())->toBe(200);
    expect($this->get('/forgot-password')->content())->toContain("Já sei a minha senha?");
});

it('Test if an admin user can login with siccess', function () {

    // criar um admin
    addAdmimUser();

    // login com admin criado
    $result = $this->post('/login', [
        "email" => 'admin@rhmangnt.com',
        "password" => 'Aa123456',
    ]);

    // verifica se o login foi feito com sucesso
    expect($result->status())->toBe(302);
    expect($result->assertRedirect('/home'));
});

it('Test if an rh user can login with siccess', function () {

    // criar o usuário rh
    addRhUser();

    // login com o rh
    $result = $this->post('/login', [
        "email" => 'rh1@rhmangnt.com',
        "password" => 'Aa123456',
    ]);

    // verifica se o user rh fez o login com sucesso
    expect($result->status())->toBe(302);
    expect($result->assertRedirect('/home'));

    // verifica se o user rh consegue acesso a página exclusiva 
    expect($this->get('/rh-users/management/home')->status())->toBe(200);
});

it('Test if an collaborator user can login with success', function () {

    // criar o usuário colaborador
    addColaboratorUser();

    // login com o colaborador
    $result = $this->post('/login', [
        "email" => 'worker1@rhmangnt.com',
        "password" => 'Aa123456',
    ]);

    // verifica se o user collaborator fez o login com sucesso
    expect($result->status())->toBe(302);
    expect($result->assertRedirect('/home'));

    // verifica se o user collaborator NÃO consegue acessar uma rota exclusiva dos Admin
    expect($this->get('/departments')->status())->not()->toBe(200);
});


function addAdmimUser()
{

    // Create admin user
    User::insert([
        'department_id' => 1,
        'name' => 'Administrador',
        'email' => 'admin@rhmangnt.com',
        'email_verified_at' => now(),
        'password' => bcrypt('Aa123456'),
        'role' => 'admin',
        'permissions' => '["admin"]',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

function addRhUser()
{

    // Create rh user
    User::insert([
        'department_id' => 2,
        'name' => 'Colaborador RH',
        'email' => 'rh1@rhmangnt.com',
        'email_verified_at' => now(),
        'password' => bcrypt('Aa123456'),
        'role' => 'rh',
        'permissions' => '["rh"]',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

function addColaboratorUser()
{

    // Create rh user
    User::insert([
        'department_id' => 3,
        'name' => 'Colaborador',
        'email' => 'worker1@rhmangnt.com',
        'email_verified_at' => now(),
        'password' => bcrypt('Aa123456'),
        'role' => 'colaborator',
        'permissions' => '["colaborator"]',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}
