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
