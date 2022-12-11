<?php

function paramFormat($string) {
    $string = preg_replace("/(script|from|select|insert|delete|where|table|show|SCRIPT|FROM|SELECT|INSERT|DELETE|WHERE|SHOW|TABLE|&|#|'|\*|--|)/","",$string);
    $string = str_replace('"', '', $string);
    $string = trim($string);
    $string = strip_tags($string);
    $string = addslashes($string);
    $string = htmlspecialchars($string);

    return $string;
}

if($_POST['function'] == 'update'){
    $id         = $_POST['id'];
    $cliente    = $_POST['cliente'];
    $cidade     = $_POST['cidade'];
    $email      = $_POST['email'];
    
    $delete = new Delete();
    return $delete->deleteClient($id, $cliente, $cidade, $email);
}

class Delete {

    public function deleteClient($id, $cliente, $cidade, $email) {
        $id         = paramFormat($id);
        $cliente    = paramFormat($cliente);
        $cidade     = paramFormat($cidade);
        $email      = paramFormat($email);

        require_once('conn.php');
        $conn = Database::connectionPDO();

        $code = $conn->prepare('UPDATE clientes SET cliente=:cliente, cidade=:cidade, email=:email WHERE id = :id');
        $code->bindParam(':id', $id);
        $code->bindParam(':cliente', $cliente);
        $code->bindParam(':cidade', $cidade);
        $code->bindParam(':email', $email);
        $code->execute();

    }
}

?>