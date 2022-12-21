<?php

class Functions {

    public function updateClient($id, $cliente, $cidade, $email) {
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
    
    public function deleteClient($id) {
        $id = paramFormat($id);

        require_once('conn.php');
        $conn = Database::connectionPDO();

        $code = $conn->prepare('DELETE FROM clientes WHERE id = :id');
        $code->bindParam(':id', $id);
        $code->execute();
    }

    public function insertClient($cliente, $cidade, $email) {
        $cliente    = paramFormat($cliente);
        $cidade     = paramFormat($cidade);
        $email      = paramFormat($email);
        // $cliente    = $_POST['cliente'];
        // $cidade     = $_POST['cidade'];
        // $email      = $_POST['email'];

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

    public function getClient() {

        require_once('conn.php');
        $conn = Database::connectionPDO();

        $code = $conn->prepare("SELECT * FROM clientes");
        $code->execute();
		$select 	= $code->fetchAll(PDO::FETCH_ASSOC);

        foreach ($select as $key => $selects) {
            $select[$key]['id']         = $selects['id'];
            $select[$key]['cliente']    = $selects['cliente'];
            $select[$key]['cidade']     = $selects['cidade'];
            $select[$key]['email']      = $selects['email'];
        }

        echo json_encode($select);
    }

}

?>