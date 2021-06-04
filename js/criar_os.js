
$(document).ready( function () {
    
    $('#btn_gravarOS').click(function(){
        //alert("Botão GRAVAR OS clicado.");
        
        id_ciclo = $('#id_ciclo').val();
        n_local = $('#n_local').val();
        n_os = $('#n_os').val();
        inicio = $('#inicio').val();
        fim = $('#fim').val();
        urnas = $('#urnas').val();
        bat = $('#bat').val();
              
        
        if (n_os == '' || inicio == '' || fim == ''){
            //alert("Preencha todos os campos.");
            var myModal = new bootstrap.Modal(document.getElementById('msgcamposVaziosModal') , true )  
            myModal.show()
            return false;
            
        }
        
        $.ajax({
            type: "POST",
            url: 'criar_os.php',
            cache: false,
            data:{id_ciclo:id_ciclo,n_local:n_local,n_os:n_os,inicio:inicio,fim:fim,urnas:urnas,bat:bat},
            success: function(dados){
            //alert(dados);
            }
        });
    });
  
});