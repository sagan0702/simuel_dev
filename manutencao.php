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
		<?php
		
	
			// $sql = "SELECT * FROM os where n_os = '$n_os' and id_ciclo = $id_ciclo";
			$sql = "UPDATE `status` SET `totue2009`='0',`totue2010`='0',`totue2011`='0',`totue2013`='0',`totue2015`='0',`totue2020`='0',`totue2022`='0',`totmiv2022`='0',`tnue_sem_chamado`='0',`tnue_com_chamado`='0',`tbat_carga_ok`='0',`tbat_sem_carga`='0',`tbat_vazando`='0',`tbat_oxidada`='0',`data_atualizacao`='NOW()' WHERE id_local = 1  " ;

			$result = $conexao->query($sql);

			
			$conexao->close();



	

		?>
		
	
	</div>
	<div class="card-footer text-muted">
						SIMUEL 
	</div>

	
</body>
</html>
