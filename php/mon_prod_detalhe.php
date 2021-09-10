<?php include_once('config.php');
if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
	$row	=	$db->getAllRecords('producao','*',' AND id_producao="'.$_REQUEST['editId'].'"');
}


?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Detalhamento da Produção</title>
	<?php
	include_once('formatacao.php');
	include_once('funcoes.php');
	
	?>
	
</head>
<body>
		<!--- MENSAGENS -->
	   	<div class="container">
		<!-- <h2>Detalhamento da Produção</h2> -->
		<?php
		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="un"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ue"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="up"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){
			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i>  Item inserido com sucesso!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Item NÃO inserido!<strong>Tente novamente!</strong></div>';
		}
		?>
				
		<!--- CAMPOS DE EDITAR -->
		<div class="card">  
			<div class="card-header">
				<!-- <i class="fa fa-fw fa-plus-circle"></i> -->
				<strong><h3>Detalhe de Produção:</h3></strong><a href="/simuel/monitorar_producao.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar OS</a>
			</div>
			<div class="card-body">
			<div class="col-sm-6">
					<form method="post">
						
					<label>Detalhe de Produção:</label>
							<?php
							$data_envio =   $row[0]['dt_envio'];
							$phpdate = strtotime( $data_envio );
							$mysqldate = date( 'd/m/Y - H:i:s' , $phpdate );
							//echo $mysqldate;
							$ciclo = $row[0]['id_ciclo'];
							$os = $row[0]['id_os'];
							$local = $row[0]['id_local'];
							$usuario = $row[0]['id_usuario'];
							

							?> 

						<!-- <div class="row"> -->
														
							<!--------------------------------------------------------->
							<div class="row">
								<div class="form-group col-md-2">
									<label>Ciclo</label>
									<input type="text" name="ciclo" id="ciclo" class="form-control" value="<?php echo identifica_ciclo ($ciclo); ?>" placeholder="" disabled>
								</div>
								<div class="form-group col-md-2">
									<label>OS:</label>
									<input type="text" name="os" id="os" class="form-control" value="<?php echo identifica_os ($os); ?>" placeholder="" disabled>
								</div>
								<div class="form-group col-md-2">
									<label>Local:</label>
									<input type="text" name="os" id="os" class="form-control" value="<?php echo identifica_local ($local); ?>" placeholder="" disabled>
								</div>
								<div class="form-group col-md-4">
									<label>Data de Envio:</label>
									<input type="text" name="data_envio" id="data_envio" class="form-control" value="<?php echo $mysqldate; ?>" placeholder="" disabled>
								</div>
								<div class="form-group col-md-3">
									<label>Usuário:</label>
									<input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo identifica_usuario ($usuario); ?>" placeholder="" disabled>
								</div>

								
							</div>
							<div class="row">
								
							</div>

							<br>




							<!--------------------------------------------------------->
							<div class="row mb-1">
								<label for="text1" class="col-sm-2 col-form-label">UE2009:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['ue2009p']; ?>" placeholder=""  >
								</div>
							</div>
							<div class="row mb-1">
								<label for="text1" class="col-sm-2 col-form-label">UE2010:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['ue2010p']; ?>" placeholder=""  >
								</div>
							</div>
							<div class="row mb-1">
								<label for="text1" class="col-sm-2 col-form-label">UE2011:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['ue2011p']; ?>" placeholder=""  >
								</div>
							</div>
							<div class="row mb-1">
								<label for="text1" class="col-sm-2 col-form-label">UE2013:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['ue2013p']; ?>" placeholder=""  >
								</div>
							</div>
							<div class="row mb-1">
								<label for="text1" class="col-sm-2 col-form-label">UE2015:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['ue2015p']; ?>" placeholder=""  >
								</div>
							</div>
							<div class="row mb-1">
								<label for="text1" class="col-sm-2 col-form-label">UE2020:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['ue2020p']; ?>" placeholder=""  >
								</div>
							</div>
							<div class="row mb-1">
								<label for="text1" class="col-sm-2 col-form-label">UE2022:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['ue2022p']; ?>" placeholder=""  >
								</div>
							</div>


							<div class="row mb-2">
								<label for="text1" class="col-sm-2 col-form-label">Total de Urnas:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['ue2022p']; ?>" placeholder=""  >
								</div>
							</div>


							<div class="row mb-1">
								<label for="text1" class="col-sm-6 col-form-label">Nº de Urnas SEM Chamado Aberto:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['nue_sem_chamado']; ?>" placeholder=""  >
								</div>
							</div>
							<div class="row mb-1">
								<label for="text1" class="col-sm-6 col-form-label">Nº de Urnas COM Chamado Aberto::</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['nue_com_chamado']; ?>" placeholder=""  >
								</div>
							</div>
							
							<div class="row mb-1">
								<label for="text1" class="col-sm-6 col-form-label">Total de Baterias Reserva:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['bat_reserva']; ?>" placeholder=""  >
								</div>
							</div>
							<div class="row mb-1">
								<label for="text1" class="col-sm-6 col-form-label">Baterias Substituídas:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['bat_subst']; ?>" placeholder=""  >
								</div>
							</div>
							<div class="row mb-1">
								<label for="text1" class="col-sm-6 col-form-label">Baterias Vazando:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['bat_vazando']; ?>" placeholder=""  >
								</div>
							</div>
							<div class="row mb-1">
								<label for="text1" class="col-sm-6 col-form-label">Baterias Oxidadas:</label>
								<div class="col-sm-2">
								<input type="text" name="n_os" id="n_os" class="form-control" disabled value="<?php echo $row[0]['bat_oxidada']; ?>" placeholder=""  >
								</div>
							</div>
							<br>
							<div class="row ">
							<div class="form-group">
								<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Voltar </button>

							</div>
						</div>

					
					</form>
				</div>
			</div>
	
	
      
</body>
</html>