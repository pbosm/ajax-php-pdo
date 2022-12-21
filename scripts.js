//MODAL FUNÇÕES
function toggleModal(size = false) {
	let modal = $('.fp-modal');

	resizeModal(size);
	
	let statusModal = true;
	if(modal.is(':visible')) {
		statusModal = false;

		$('.c-modal').html('');
		resetTutorial();
	}

	modal.attr('show', statusModal);
	$('.b-modal').scrollTop(0);

    $('.x-modal').click(function(){
        toggleModal();
    });
}

function resetTutorial() {
	currentTutorial = 1;
}

function resizeModal(size = false) {
	$('.b-modal').removeClass('modal-small modal-large');

	let classes = {
		'small': 'modal-small',
		'large': 'modal-large',
	};	

	$('.b-modal').addClass((classes[size]) ? classes[size] : '');
}

function showClients() {
    var URL = "select.php";
	$("#msg").empty();

	$.ajax({
		type: 'POST',
		url: URL,
		data: {
            function: 'select'
		},
        dataType: 'json',
		success: function(select) {
              
        $('.h-modal-title').html('Clientes');
        let html = $('#templateSelectClient').html();
        $('.c-modal').html(html);
        toggleModal();

        for(let prop in select){
            let selects = select[prop];
            let html = $('#templateRowSelectClient').html();

            html = html.replace(/{{order}}/g);
            html = html.replace('{{cliente}}', selects.cliente);
            html = html.replace('{{cidade}}', selects.cidade);
            html = html.replace('{{email}}', selects.email);

            html = html.replace('{{idedit}}', selects.id);
            html = html.replace('{{clienteedit}}', selects.cliente);
            html = html.replace('{{cidadeedit}}', selects.cidade);
            html = html.replace('{{emailedit}}', selects.email);
       
            html = html.replace('{{iddelete}}', selects.id);
            html = html.replace('{{clientedelete}}', selects.cliente);
            $('table.clients tbody').append(html);
        }
    },
    error:function(){
        $('#msg').html('Erro ao trazer tabela');
    }
	});
}

function createClient() {
    var URL = "insert.php";
	$("#msg").empty();

    $(document).ready(function(){
        $("#salvar").on('click',function(){

            var cliente = $('#cliente').val();
            var cidade  = $('#cidade').val();
            var email   = $('#email').val();
            
            $.ajax({
                type: 'POST',
                url: URL,
                data: {
                        cliente : cliente,                       
                        cidade  : cidade,
                        email   : email,
                        function: 'create'  
                    },
                    beforeSend: function(){
                        $('#msg').html('Carregando...');
                    },
                    success:function(data){
                        $('#msg').html(data);
                    },
                    error:function(data){
                        $('#msg').html('Página não encontrada');
                    }
            });
        });
    });
}

function editClient(id, cliente, cidade, email) {
    var URL = "update.php";
    $('.h-modal-title').html('Clientes');
    let html = $('#templateEditClient').html();
    $('.c-modal').html(html);
	$("#msg").empty();

    $('input[name="txtCliente"]').val(cliente);
    $('input[name="txtCidade"]').val(cidade);
    $('input[name="txtEmail"]').val(email);

    $('#edit-client').validate({
		rules: {
			txtCliente: {
				required: true
			},
			txtCidade: {
				required: true
			},
            txtEmail: {
				required: true
			},
		},
		messages: {
			txtCliente: {
				required: 'Informe um nome'
			},
			txtCidade: {
				required: 'Informe sua cidade'
			},
            txtEmail: {
				required: 'Informe sua email'
			},
		},
		submitHandler: function (form) {
			$.ajax({
                type: 'POST',
                url: URL,
                data: {
                    id      :   id,
                    cliente :   $('input[name="txtCliente"]').val(),
                    cidade  :   $('input[name="txtCidade"]').val(),
                    email   :   $('input[name="txtEmail"]').val(),
                    function:   'update'
                },
				success: function(response) {
					let obj = response;
					if(obj.status == 'erro'	) {
						showError(obj.data);
					} else {
						$('#msg').html($('input[name="txtCliente"]').val() + ' editado com sucesso');
						toggleModal();
					}
				},
				error: function(){
					showError('Erro interno');
				}
			});
		}
	});
}

function deleteClient(id, cliente) {
    var URL = "delete.php";
	$("#msg").empty();

    $.ajax({
        type: 'POST',
        url: URL,
        data: {
            id:       id,
            function: 'delete'
        },
        success: function(data) {
            $('#msg').html(cliente + ' apagado com sucesso')
            toggleModal();
        },
        error:function(){
            $('#msg').html('Erro ao excluir cliente');
        }
    });
}