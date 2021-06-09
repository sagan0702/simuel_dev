<?php include_once('config.php');
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
extract($_REQUEST);
// 	if($n_os==""){
// 		header('location:'.$_SERVER['PHP_SELF'].'?msg=un');
// 		exit;
// 	}elseif($n_ciclo==""){
// 		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue');
// 		exit;
// 	}else{
		
		//converter para data br -> data mysql
		var_dump($_POST);
		$userCount	=	$db->getQueryCount('producao','id_producao');
		if($userCount[0]['total']<20){
			$data	=	array(
							'id_ciclo'=>$id_ciclo,
							'id_os'=>$id_os,
							'id_local'=>$id_local,
							'n_os'=>$n_os,
							'ue2009p'=>$ue2009p,
							'ue2010p'=>$ue2010p,
							'ue2011p'=>$ue2011p,
							'ue2013p'=>$ue2013p,
							'ue2015p'=>$ue2015p,
							'ue2020p'=>$ue2020p,
							'ue2022p'=>$ue2022p,
							'nue_sem_chamado'=>$nue_sem_chamado,
							'nue_com_chamado'=>$nue_com_chamado,
							'bat_carga_ok'=>$bat_carga_ok,
							'bat_sem_carga'=>$bat_sem_carga,
							'bat_vazando'=>$bat_vazando,
							'bat_oxidada'=>$bat_oxidada,
							'observacao'=>$observacao,
						);
			$insert	=	$db->insert('producao',$data);
			if($insert){
				header('location:/simuel/producao_local.php?msg=ras');
				exit;
			}else{
				header('location:/simuel/producao_local.php?msg=rna');
				exit;
			}
		}else{
			header('location:'.$_SERVER['PHP_SELF'].'?msg=dsd');
			exit;
		}
	// }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Adicionar Produção Local</title>
  	<?php include_once('formatacao.php');
	include_once('consulta_ciclo_os.php');
    include ("conexao.php");
	// session_start();
       
	     
    ?>
</head>
<body>

	<!--- MENSAGENS -->
   	<div class="container">
		<!-- <h3>Adicionar Produção Local</h3> -->
		<?php  
		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="un"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ue"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="up"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){
			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Item inserido com sucesso!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Item NÃO inserido! <strong>Tente novamente!</strong></div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="dsd"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Please delete and then try again <strong>We set limit for security reasons!</strong></div>';
		}

		?>

			

		<div class="card">   <!---CARD ADICIONAR --->
			<div class="card-header"> <h3>Adicionar Produção Local</h3> 
				<a href="/simuel/producao_local.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar Produção</a>
			</div>
			<div class="card-body">		
			
					<form method="post">
					<!-- CAMPOS AUX --->	
					<div id="id_os" name="id_os"><?= $_SESSION['max_id_os'] ?></div>
					<div id="id_ciclo" name="id_ciclo"><?= $_SESSION['max_id_ciclo'] ?></div>
					<div id="id_local" name="id_local"><?= $_SESSION['id_local'] ?></div>
					<div id="n_os" name="n_os"><?= $_SESSION['max_n_os'] ?></div>
					<?php
					// $id_ciclo = $_SESSION['max_id_ciclo'];
					// $id_os = $_SESSION['max_id_os'];
					// $id_local = $_SESSION['id_local'];
							
					
					?>

				

					<!-- FIM CAMPOS AUX --->


						<div class="row">
						<div class="col-md-3 ">
								<label>Nº do Ciclo: </label>
								<div id="n_ciclo" name="n_ciclo"><?= $_SESSION['max_n_ciclo'] ?></div>
							</div>
							<div class="col-md-3 ">
								<label>Nº da OS:</label>
								<div id ="n_os" name="n_os" > <?= $_SESSION['max_n_os'] ?>  </div>
							</div>
							<div class="col-md-3 ">
								<label>Local:</label>
								<div id ="local" name="n_local"  > <?= $_SESSION['local'] ?>  </div>
							</div>
							<div class="col-md-3 ">
								<label>Data:</label>
								<h6>  <?php echo date('d/m/Y') ?> <h6> 
							</div>
							
						</div>

						<div class="row">
							<div class="col-md-12">
							</br> <!--- QUEBRA DE LINHA NO LAYOUT -->
								<label> <h5>Total Urnas com STE realizado</h5></label>

							</div>
						
							<div class="col-md-2">
								<label for="urna09">UE2009:</label>
								<input type="text" class="form-control" name="ue2009p" id="ue2009p"  onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2 ">
								<label for="urna10">UE2010:</label>
								<input type="text" class="form-control" name="ue2010p" id="ue2010p"  onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2 ">
								<label for="urna11">UE2011:</label>
								<input type="text" class="form-control"  name="ue2011p" id="ue2011p"  onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2 ">
								<label for="urna13">UE2013:</label>
								<input type="text" class="form-control" name="ue2013p" id="ue2013p"  onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2 ">
								<label for="urna15">UE2015:</label>
								<input type="text" class="form-control" name="ue2015p" id="ue2015p" onkeypress="$(this).mask('0000')"  >
							</div>
							
						
						</div>
						
						<div class="row">
							<div class="col-md-2 ">
								<label for="urna21">UE2020:</label>
								<input type="text" class="form-control" name="ue2020p" id="ue2020p" onkeypress="$(this).mask('0000')"  >
							</div>
							<div class="col-md-2">
								<label for="urna22">UE2022:</label>
								<input type="text" class="form-control" name="ue2022p" id="ue2022p" onkeypress="$(this).mask('0000')"  >
							</div>
						</div>
						</br> <!--- QUEBRA DE LINHA NO LAYOUT -->
						<div class="form-row">
						
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="urna21"><h5>Chamados de Manutenção Corretiva:</h5></label>
								<div class="col-md-12">
								</div>
							</div>
							<div class="col-md-2 ">
								<label for="urna21">Urnas COM chamado aberto:</label>
								<input type="text" class="form-control" name="nue_com_chamado"  id="nue_com_chamado" onkeypress="$(this).mask('0000')" required>
							</div>
							<div class="col-md-2">
								<label for="urna22">Urnas SEM chamado aberto:</label>
								<input type="text" class="form-control" name="nue_sem_chamado" id="nue_sem_chamado" onkeypress="$(this).mask('0000')" required>
							</div>
						</div>	
						</br> <!--- QUEBRA DE LINHA NO LAYOUT -->
						<div class="row">
							<div class="col-md-12 ">
								<label for="urna21"><h5>Situação das baterias</h5></label>
							</div>
							<div class="col-md-2">
								<label for="urna22">Recarregadas:</label>
								<input type="text" class="form-control" name="bat_carga_ok" id="bat_carga_ok" onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2">
								<label for="urna22">Sem carga:</label>
								<input type="text" class="form-control" name="bat_sem_carga" id="bat_sem_carga" onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2">
								<label for="urna22">Com vazamento:</label>
								<input type="text" class="form-control" name="bat_vazando" id="bat_vazando" onkeypress="$(this).mask('0000')" >
							</div>
							<div class="col-md-2">
								<label for="urna22">Com oxidação:</label>
								<input type="text" class="form-control" name="bat_oxidada"  id="bat_oxidada" onkeypress="$(this).mask('0000')" >
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="urna22">Observações (opcional):</label>
								<input type="text" class="form-control" name="observacao" id="observacao" >
								</div>	
						</div>	
						
						
						<div class="col-md-2 ">
							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Adicionar Produção</button>
						</div>
					</form>
				</div>
						
			</div> 
			<div class="card-footer text-muted">
				SIMUEL 
			</div>
		</div>
	
						

	</div>
	<div class="container my-4">	
	</div>
 
	<script>
		$('#data_inicio').datepicker({	
			format: "yyyy/mm/dd",	
			language: "pt-BR",
			startDate: '+0d',
			
		});
		
		$('#data_fim').datepicker({	
				
			format: "yyyy/mm/dd",
			language: "pt-BR",
			startDate: '+0d',
		});
		
		
	</script>
</body>
</html>