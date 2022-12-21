<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

// $function  = json_decode(file_get_contents("php://input"), true)['Functions'];
// $content   = json_decode(json_decode(file_get_contents("php://input"), true)['Functions'], true);
$class = 'Functions';

require_once('Functions.php');

class Rest {
    // Executa a Classe e Função recebida por URL e envia os parâmetros por GET ou POST
    public static function open($class) {
        try {

            // Retorna o sucesso da execução
            if (class_exists($class)) {
                if (method_exists($class)) {
                    $return = call_user_func_array(array(new $class));

                    return json_encode(array('status' => 'success', 'data' => $return));
                } else {
                    return json_encode(array('status' => 'erro', 'data' => 'Método inexistente!'));
                }
            } else {
                return json_encode(array('status' => 'erro', 'data' => 'Classe inexistente!'));
            }
        } catch (Exception $e) {	
            // Retorna o erro caso exista
            $errorMessage 	= $e->getMessage();

            echo json_encode(array('status' => 'erro', 'data' => $errorMessage));
        }
        
    }
}

if (isset($class)) {
    echo Rest::open($class);
}
