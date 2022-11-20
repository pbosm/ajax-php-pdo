<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP com Ajax</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" type="text/javascript"></script>
    <script src="scripts.js"></script>
</head>
<body>
    <span>Nome do Cliente: </span><br>
        <input type="text" id="cliente"><br>
    <span>Cidade: </span><br>
        <input type="text" id="cidade"><br>
    <span>Email: </span><br>
        <input type="email" id="email"><br><br>
    <button id="salvar">Enviar</button> 
    <button id="select" style="margin-left: 5px;" onclick="showClient()">Ver usuários</button>
    <br><div id="msg" style="margin-top: 5px;"></div>    
    
    <script>
	    createClient();
    </script>

</body>
</html>