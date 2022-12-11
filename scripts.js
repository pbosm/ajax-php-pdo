//MODAL FUNÇÕES
let currentTutorial = 1;
let selects;

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

	$.ajax({
		type: 'POST',
		url: 'select.php',
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
            html = html.replace('{{id}}', selects.id);
            html = html.replace('{{iddelete}}', selects.id);
            html = html.replace('{{cliente}}', selects.cliente);
            html = html.replace('{{cidade}}', selects.cidade);
            html = html.replace('{{email}}', selects.email);
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

function editClient(id) {
console.log(id);
}

function deleteClient(id) {
console.log(id);
}
