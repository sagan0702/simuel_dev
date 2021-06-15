<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Manutenção</title>
	<?php 
	include_once('php/formatacao.php');
    include ("php/bootstrapalert.php");
	?>
	<?php
        session_start();
        include ("php/conexao.php");
       
        
        $dadosConexao = mysqli_get_host_info($conexao);
            if (!isset($_SESSION["usuario"])) {
                header('Location: index.php');
                exit();
            }
            include($_SESSION['menu']); 
    ?>
</head>
<body>
	
   	<div class="container">
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
			<h3>Manutenção</h3>
			
			<div class="card-body"> <!--- MENSAGENS -->
			<a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Zerar Status</a>
			<a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Zerar Produção</a>
			<a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Link primário</a>
	
					
				
				
			
			
			</div>
		
	
	</div>
	<div class="card-footer text-muted">
						SIMUEL 
	</div>

	
</body>
</html>
