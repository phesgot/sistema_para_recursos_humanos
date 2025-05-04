<?php

it('Tests if an admin user can see the RH users page', function(){

    // criar o admim
    addAdmimUser();

    // efetuar o login com o admin 
    auth()->loginUsingId(1);

    // verifica se acede com sucesso à página de RH users
    expect($this->get('/rh-users')->status())->toBe(200);
});

it('Test if is not possible to access the home page without logged user', function(){

    // verifica se é possível aceder à home page
    expect($this->get('/home')->status())->toBe(302);

    // ou
    //expect($this->get('/home')->status())->not()->toBe(200);
});

it('Test if user logged in can access to the login page', function(){

    // adcionar admin à base de dados
    addAdmimUser();

    // login automático
    auth()->loginUsingId(1);

    expect($this->get('/login')->status())->not()->toBe(200);

});

it('Test if user logged in can access to the recover password page', function(){

    // adcionar admin à base de dados
    addAdmimUser();

    // login automático
    auth()->loginUsingId(1);

    expect($this->get('/forgot-password')->status())->toBe(302);

});

