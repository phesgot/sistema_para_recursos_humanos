<?php

it('display the login page when not logged in', function(){

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
