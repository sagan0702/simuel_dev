<?php include_once('config.php');
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($n_local==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un');
		exit;
	}elseif($sede==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue');
		exit;
	}elseif($qtde_infra==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');
		exit;
	}else{
		
		//converter para data br -> data mysql
		
		$userCount	=	$db->getQueryCount('local','id_local');
		if($userCount[0]['total']<20){
			$data	=	array(
							
							
				// `id_local`, `c`, `sede`, `qtde_ue2009`, `qtde_ue2010`, `qtde_ue2011`, `qtde_ue2013`,
				// `qtde_ue2015`, `qtde_ue2020`, `qtde_ue2022`, `qtde_miv_2022`, `qtde_baterias`, `data_atualizacao`, `qtde_infra`

							'n_local'=>$n_local,
							'sede'=>$sede,
							'qtde_ue2009'=>$qtde_ue2009,
							'qtde_ue2010'=>$qtde_ue2010,
							'qtde_ue2011'=>$qtde_ue2011,
							'qtde_ue2013'=>$qtde_ue2013,
							'qtde_ue2015'=>$qtde_ue2015,
							'qtde_ue2020'=>$qtde_ue2020,
							'qtde_ue2022'=>$qtde_ue2022,
							'qtde_baterias'=>$qtde_baterias,
							'qtde_infra'=>$qtde_infra,



						);
			$insert	=	$db->insert('local',$data);
			if($insert){
				header('location:/simuel/locais.php?msg=ras');
				exit;
			}else{
				header('location:/simuel/locais.php?msg=rna');
				exit;
			}
		}else{
			header('location:'.$_SERVER['PHP_SELF'].'?msg=dsd');
			exit;
		}
	}
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Adicionar Local</title>
  	<?php include_once('formatacao.php');?>
</head>
<body>

	<!--- MENSAGENS -->
   	<div class="container">
		<h3>Adicionar Local</h3>
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
			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Adicionar Locais</strong> 
				<a href="/simuel/locais.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar Locais</a>
			</div>
			<div class="card-body">		
				<div class="col-sm-6">
					
					<form method="post">
						<div class="row">

							<!-- `id_local`, `n_local`, `sede`, `qtde_ue2009`, `qtde_ue2010`, `qtde_ue2011`, `qtde_ue2013`,
							`qtde_ue2015`, `qtde_ue2020`, `qtde_ue2022`, `qtde_miv_2022`, `qtde_baterias`, `data_atualizacao`, `qtde_infra` -->


							<div class="form-group">
								<label><h6>Local</label></h6>
								<input type="text" name="n_local" id="n_local" class="form-control"  required></input>
							</div>
							<div class="form-group">
								<label><h6>Sede</label></h6>
								<input type="text" name="sede" id="sede" class="form-control"  required></input>
							</div>
							<div class="form-group">
								<label><h6>Nº de Urnas UE2009</label></h6>
								<input type="text" name="qtde_ue2009" id="qtde_ue2009" class="form-control"  required></input>
							</div>
							<div class="form-group">
								<label><h6>Nº de Urnas UE2010</label></h6>
								<input type="text" name="qtde_ue2010" id="qtde_ue2010" class="form-control"  required></input>
							</div>
							<div class="form-group">
								<label><h6>Nº de Urnas UE2011</label></h6>
								<input type="text" name="qtde_ue2011" id="qtde_ue2011" class="form-control"  required></input>
							</div>
							<div class="form-group">
								<label><h6>Nº de Urnas UE2013</label></h6>
								<input type="text" name="qtde_ue2013" id="qtde_ue2013" class="form-control"  required></input>
							</div>
							<div class="form-group">
								<label><h6>Nº de Urnas UE2015</label></h6>
								<input type="text" name="qtde_ue2015" id="qtde_ue2015" class="form-control" required></input>
							</div>
							<div class="form-group">
								<label><h6>Nº de Urnas UE2020</label></h6>
								<input type="text" name="qtde_ue2020" id="qtde_ue2020" class="form-control" required></input>
							</div>
							<div class="form-group">
								<label><h6>Nº de Urnas UE2022</label></h6>
								<input type="text" name="qtde_ue2022" id="qtde_ue2022" class="form-control"  required></input>
							</div>
							<div class="form-group">
								<label><h6>Qtde de Baterias reserva</label></h6>
								<input type="text" name="qtde_baterias" id="qtde_baterias" class="form-control"  required></input>
							</div>
							<div class="form-group">
								<label><h6>Valor de QInfra</label></h6>
								<input type="text" name="qtde_infra" id="qtde_infra" class="form-control" required></input>
							</div>
							
						</div> 
						
						<div class="row ">
							<div class="form-group col-md-6">
								<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Adicionar Local</button>

							</div>
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
		
		
		
	</script>
</body>
</html>