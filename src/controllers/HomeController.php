<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\HomeHandler;

class HomeController extends Controller {

    public function index() {

        $address = array();

        if(isset($_POST['cep'])){
            
            // RECEBIMENTO DO CEP VIA POST
            $cep = filter_input(INPUT_POST, 'cep');
    
            // REMOVE ESPAÇOS EM BRANCO ANTES E DEPOIS DO CEP
            $cep = trim($cep);
    
            // VALIDA O CEP
            $validateCep = preg_match("/^[\d]+$/", $cep);
            if($validateCep != false && strlen($cep) == 8) {

                //VERIFICA SE ESTA NO BANCO DE DADOS
                if(HomeHandler::readAddress($cep) == false){
                    
                    //REQUISIÇÃO AO VIA CEP
                    $req = file_get_contents("https://viacep.com.br/ws/$cep/xml/");
                    $address = simplexml_load_string($req);
                    
                    //CONVERTE O XML EM ARRAY
                    $json = json_encode($address);
                    $res = json_decode($json, TRUE);

                    //VERIFICA SE O CEP EXISTE
                    if(!isset($res['erro'])){

                        HomeHandler::addAddress($res);
                        
                        $address = $res;

                        //CRIA LINK GOOGLE MAPS
                        $map = $address['logradouro'].'+-+'.$address['bairro'].'+-+'.$address['localidade'];
                        $address['map'] = str_replace(' ', '+', $map);

                    }else{
                        $address['notExists'] = true;
                    }
                }else{

                    //RETORNA O REGISTRO DO BACON DE DADOS
                    $address = HomeHandler::readAddress($cep);

                    //CRIA LINK GOOGLE MAPS
                    $map = $address['logradouro'].'+-+'.$address['bairro'].'+-+'.$address['localidade'];
                    $address['map'] = str_replace(' ', '+', $map);
                }

            }
            else {
                $address['cepInvalid'] = true;
            }
        }


        $this->render('home', ['address' => $address]);
    }

}