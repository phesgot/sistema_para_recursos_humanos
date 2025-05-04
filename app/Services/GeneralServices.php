<?php


namespace App\Services;

class GeneralServices
{
    public static function checkIsSalaryIsGreaterThan($salary, $amount)
    {
        return $salary > $amount;
    }

    public static function createPhraseWithNameAndSalary($name, $salary)
    {
        return "O salário do(a) $name é R$ $salary";
    }

    public static function getSalaryWithBonus($salary, $bonus)
    {
        return $salary + $bonus;
    }

    public static function fakeDataInJason()
    {
        // cria 10 clientes com dados falsos 
        $clients = [];

        for ($i = 0; $i < 10; $i++){
            $clients[] = [
                'name' => \Faker\Factory::create()->name(),
                'email' => \Faker\Factory::create()->email(),
                'phone' => \Faker\Factory::create()->phoneNumber(),
                'address' => \Faker\Factory::create()->address(),
            ];
        }

        return json_encode($clients, JSON_PRETTY_PRINT);
    }

}