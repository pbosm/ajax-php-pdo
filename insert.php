<?php

    $conn = new PDO('mysql:host=localhost;dbname=ajaxphp', "root", "");

    $data = date("d-m-Y");

    $sql = $conn->prepare("INSERT INTO clientes (cliente, cidade, email) VALUES ('".$_POST['cliente']."','".$_POST['cidade']."','".$_POST['email']."')");

    $sql->execute();

    if($sql == true) {
        echo 'Cadastrado com sucesso';
    } else {
        echo 'Houve um erro';
    }

?>