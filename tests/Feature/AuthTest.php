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

    // login com admin criado
    $result = $this->post('/login', [
        "email" => 'admin@rhmangnt.com',
        "password" => 'Aa123456',
    ]);

    // verifica se o login foi feito com sucesso
    expect($result->status())->toBe(302);
    expect($result->assertRedirect('/home'));
});
