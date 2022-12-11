<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP com Ajax</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
    <style>/* Modal Styles */
.fp-modal {
	overflow-y: auto;
	width: 100vw;
	height: 100vh;
	background-color: rgba(0, 0, 0, 0.5);
	position: fixed;
	z-index: 9999999;
	top: 0;
	left: 0;
	justify-content: center;
	align-items: center;
	display: none;
}

.fp-modal[show="true"] {
	display: flex;
}

.fp-modal[show="true"] .b-modal {
	animation: a-modal .3s;
}

.b-modal {
	position: relative;
	width: 60%;
	max-height: 90vh;
	overflow-y: auto;
	top: 0;
	min-width: 300px;
	background-color: white;
	border-radius: 5px;
	margin: 20px 0;
}

.b-modal.modal-small {
	width: 30%;
}

.b-modal.modal-large {
	width: 95%;
}

@keyframes a-modal {
	from {
		opacity: 0;
		transform: translate3d(0, -60px, 0);
	}

	to {
		opacity: 1;
		transform: translate3d(0, 0, 0);
	}
}

.h-modal {
	padding: 15px;
	border-bottom: 1px solid rgba(0, 0, 0, 0.25);
	font-size: 20px;
	position: relative;
}

.c-modal {
	padding: 15px;
}

.x-modal {
	font-size: 25px;
	width: 35px;
	height: 35px;
	border-radius: 5px;
	border: 0;
	background-color: transparent;
	position: absolute;
	right: 10px;
	top: 10px;
	cursor: pointer;
	z-index: 99999999;
}</style>
</head>
<body>

<script type="text/html" id="templateRowSelectClient">
     <tr data-table-order="{{order}}">
          <td data-column="cliente">{{cliente}}</td>
          <td data-column="cidade">{{cidade}}</td>
          <td data-column="email">{{email}}</td>
          <td data-column="delete" onclick="editClient('{{id}}')" class='btn btn-primary'>Editar</td>
          <td data-column="edit" onclick="deleteClient('{{iddelete}}')" class='btn btn-danger'>Excluir</td>
     </tr>
</script>

<script type="text/html" id="templateSelectClient">
     <div class="row ml-0">
		<div class="col-12">
               <div class="table-responsive">
                    <table class="table w-100 text-center table-striped clients">
                         <thead>
                              <tr>
                                   <th>
                                        Cliente
                                   </th>
                                   <th>
                                        Cidade
                                   <th>
                                        Email
                                   </th>
                                   <th>
                                        Opções
                                   </th>
                              </tr>
                         </thead>
                         <tbody>
                         </tbody>
                    </table>
               </div>
		</div>
	</div>
</script>

<div class="fp-modal" show="false">
    <div class="b-modal">
        <div class="h-modal">
            <span class="h-modal-title">
                {{modalTitle}}
            </span>
            <button class="x-modal">&#x2715;</button>
        </div>
        <div class="c-modal">
        </div>
    </div>
</div>

<div class="text-center mt-4">
    <span class="text center">Nome do Cliente: </span><br>
        <input type="text" id="cliente"><br>
    <span>Cidade: </span><br>
        <input type="text" id="cidade"><br>
    <span>Email: </span><br>
        <input type="email" id="email"><br><br>
    <button id="salvar">Cadastrar</button> 
    <button id="select" onclick="showClients()">Ver usuários</button>

    <br><div id="msg" style="margin-top: 10px;"></div>    
</div>    

    <script>
	    createClient();
    </script>

</body>
</html>