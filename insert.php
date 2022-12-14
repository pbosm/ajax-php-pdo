<?php

if($_POST['function'] == 'create'){
    $create = new Create();
    return $create->insertClient();
}

class Create {

    public function insertClient() {
        $cliente    = $_POST['cliente'];
        $cidade     = $_POST['cidade'];
        $email      = $_POST['email'];

        require_once('conn.php');
        $conn = Database::connectionPDO();

        $sql = $conn->prepare("INSERT INTO clientes (cliente, cidade, email) VALUES (:cliente, :cidade, :email)");
        $sql->bindValue(':cliente', $cliente);
        $sql->bindValue(':cidade', $cidade);
        $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql == true) {
            echo $cliente, ' Cadastrado com sucesso';
        } else {
            echo 'Houve um erro';
        }
    }
}

?>