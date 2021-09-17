<?php
namespace src\handlers;

use \src\models\Address;

class homeHandler {
    
    public static function readAddress($cep){

        $address = Address::select()
            ->where('cep', $cep)
            ->first();
    
        return $address;

    }

    public static function addAddress($address){
        
        Address::insert([

            'cep' => str_replace('-', '', $address['cep']),
            'logradouro' => $address['logradouro'],
            'bairro' => $address['bairro'],
            'localidade' => $address['localidade'],
            'uf' => $address['uf']

        ])->execute();
    }

}