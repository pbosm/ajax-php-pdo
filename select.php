<?php

if($_POST['function'] == 'select'){
    $select = new Select();
    $select->getClient();
}

class Select {

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