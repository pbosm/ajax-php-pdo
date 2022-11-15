function createClient() {
    $(document).ready(function(){
        $("#salvar").on('click',function(){
            $.ajax({
                url: 'insert.php',
                type: 'POST',
                data: {nome:    $('#cliente').val(),                       
                       cidade:  $('#cidade').val(),
                       email:   $('#email').val()
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