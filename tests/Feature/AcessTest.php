<?php

it('Tests if an admin user can see the RH users page', function(){

    // criar o admim
    addAdmimUser();

    // efetuar o login com o admin 
    auth()->loginUsingId(1);

    // verifica se acede com sucesso à página de RH users
    expect($this->get('/rh-users')->status())->toBe(200);
});
