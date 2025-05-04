<?php

use App\Services\GeneralServices;

it('Tests if the salary is grater than a specific amount', function(){
    $salary = 1000;
    $amount = 500;

    $result = GeneralServices::checkIsSalaryIsGreaterThan($salary, $amount);

    expect($result)->toBeTrue();
});

it('Tests if the salary is not grater than a specific amount', function(){
    $salary = 1000;
    $amount = 1500;

    $result = GeneralServices::checkIsSalaryIsGreaterThan($salary, $amount);

    expect($result)->toBeFalse();
});

it('Tests if the phrase is created correctly', function(){
    $name = "Pedro Torres";
    $salary = "1000";

    $result = GeneralServices::createPhraseWithNameAndSalary($name, $salary);

    expect($result)->toBe('O salário do(a) Pedro Torres é R$ 1000');

})->only('vai executar somente este teste');

it('Tests if the salary with bonus', function(){
    $salary = 1000;
    $bonus = 500;

    $result = GeneralServices::getSalaryWithBonus($salary, $bonus);

    expect($result)->toBe(1500);

})->todo('código do teste não está completo');

it('Tests if the fake json data is created correctly', function(){

    $results = GeneralServices::fakeDataInJason();

    $clients = json_decode($results, true);

    expect(count($clients))->toBeGreaterThanOrEqual(1);
    expect($clients[0])->toHaveKeys(['name','email','phone','address']);
})->skip('Inativo temporariamente');