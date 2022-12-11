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

if($_POST['function'] == 'delete'){
    $id = $_POST['id'];
    
    $delete = new Delete();
    return $delete->deleteClient($id);
}

class Delete {

    public function deleteClient($id) {
        $id = paramFormat($id);

        require_once('conn.php');
        $conn = Database::connectionPDO();

        $code = $conn->prepare('DELETE FROM clientes WHERE id = :id');
        $code->bindParam(':id', $id);
        $code->execute();
    }
}

?>