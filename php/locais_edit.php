<?php include_once('config.php');
if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
	$row	=	$db->getAllRecords('local','*',' AND id_local="'.$_REQUEST['editId'].'"');
}
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($qtde_infra==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un&editId='.$_REQUEST['editId']);
		exit;
	// }elseif($data_inicio==""){
	// 	header('location:'.$_SERVER['PHP_SELF'].'?msg=ue&editId='.$_REQUEST['editId']);
	// 	exit;
	// }elseif($data_fim==""){
	// 	header('location:'.$_SERVER['PHP_SELF'].'?msg=up&editId='.$_REQUEST['editId']);
	// 	exit;
	}
	$data_inicio = implode("-",array_reverse(explode("/",$data_inicio)));
	$data_fim = implode("-",array_reverse(explode("/",$data_fim)));

	$data	=	array(
					'qtde_ue2009'=>$qtde_ue2009,
					'qtde_ue2010'=>$qtde_ue2010,
					'qtde_ue2009'=>$qtde_ue2011,
					'qtde_ue2010'=>$qtde_ue2013,
					'qtde_ue2009'=>$qtde_ue2015,
					'qtde_ue2010'=>$qtde_ue2020,
					'qtde_ue2009'=>$qtde_ue2022,
					'qtde_ue2010'=>$qtde_ue2010,
					'qtde_baterias'=>$qtde_baterias,
					'qtde_infra'=>$qtde_infra,
					);
	$update	=	$db->update('local',$data,array('id_local'=>$editId));
	if($update){
		header('location: /simuel/locais.php?msg=rus');
		exit;
	}else{
		header('location: /simuel/locais.php?msg=rnu');
		exit;
	}
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Editar Ciclo</title>
	<!-- <?//php include_once('locais.php');?> -->
	<?php include_once('formatacao.php');?>
	
</head>

<body>
	
		<!--- MENSAGENS -->
	
   	<div class="container">
		<h2><Editar Ciclo </h2>
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
							<!-- converter para data br -> data mysql
							$data_inicio = implode("-",array_reverse(explode("/",$data_inicio)));
							$data_fim = implode("-",array_reverse(explode("/",$data_fim))); -->


							<!-- connverter data mysql -> data BR
       						$data_inicio = implode("/",array_reverse(explode("-",$data_inicio)));
       						$data_fim = implode("/",array_reverse(explode("-",$data_fim))); -->


		<!--- CAMPOS DE EDITAR -->
		<div class="card">  
			<div class="card-header">
				<!-- <i class="fa fa-fw fa-plus-circle"></i> -->
				<strong><h3>Editar Local</h3></strong><a href="/simuel/ciclos.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar Locais</a>
			</div>
			<div class="card-body">
				
				<div class="col-sm-6">
					<h3 class="card-title"><h5>Campos com<span class="text-danger">*</span> são obrigatórios!</h5>
					<form method="post">
						<!-- `id_local`, `n_local`, `sede`, `qtde_ue2009`, `qtde_ue2010`, `qtde_ue2011`, `qtde_ue2013`,
							`qtde_ue2015`, `qtde_ue2020`, `qtde_ue2022`, `qtde_miv_2022`, `qtde_baterias`, `data_atualizacao`, `qtde_infra` -->

						<div class="row">
							<div class="form-group  col-md-4">
								<label><h6>Local</label></h6>
								<input type="text" name="n_local" id="n_local" class="form-control" value="<?php echo $row[0]['n_local']; ?>" placeholder="" required>
							</div>
							<div class="form-group col-md-4">
								<label><h6>Sede</label></h6>
								<input type="text" name="sede" id="sede" class="form-control" value="<?php echo $row[0]['sede']; ?>" placeholder="" required>
							</div>
						</div>	
						<div class="row">
							<div class="form-group col-md-3">
								<label><h6>Nº de Urnas UE2009</label></h6>
								<input type="text" name="qtde_ue2009" id="qtde_ue2009" class="form-control" value="<?php echo $row[0]['qtde_ue2009']; ?>" placeholder="" required>
							</div>
							<div class="form-group col-md-3">
								<label><h6>Nº de Urnas UE2010</label></h6>
								<input type="text" name="qtde_ue2010" id="qtde_ue2010" class="form-control" value="<?php echo $row[0]['qtde_ue2010']; ?>" placeholder="" required>
							</div>
							<div class="form-group col-md-3">
								<label><h6>Nº de Urnas UE2011</label></h6>
								<input type="text" name="qtde_ue2011" id="qtde_ue2011" class="form-control" value="<?php echo $row[0]['qtde_ue2011']; ?>" placeholder="" required>
							</div>
							<div class="form-group col-md-3">
								<label><h6>Nº de Urnas UE2013</label></h6>
								<input type="text" name="qtde_ue2013" id="qtde_ue2013" class="form-control" value="<?php echo $row[0]['qtde_ue2013']; ?>" placeholder="" required>
							</div>
						

						</div>
						<div class="row">	

							<div class="form-group col-md-3">
								<label><h6>Nº de Urnas UE2015</label></h6>
								<input type="text" name="qtde_ue2015" id="qtde_ue2015" class="form-control" value="<?php echo $row[0]['qtde_ue2015']; ?>" placeholder="" required>
							</div>
							<div class="form-group col-md-3">
								<label><h6>Nº de Urnas UE2020</label></h6>
								<input type="text" name="qtde_ue2020" id="qtde_ue2020" class="form-control" value="<?php echo $row[0]['qtde_ue2020']; ?>" placeholder="" required>
							</div>
							<div class="form-group col-md-3">
								<label><h6>Nº de Urnas UE2022</label></h6>
								<input type="text" name="qtde_ue2022" id="qtde_ue2022" class="form-control" value="<?php echo $row[0]['qtde_ue2022']; ?>" placeholder="" required>
							</div>
							<div class="form-group col-md-3">
								<label><h6>Qtde de Baterias reserva</label></h6>
								<input type="text" name="qtde_baterias" id="qtde_baterias" class="form-control" value="<?php echo $row[0]['qtde_baterias']; ?>" placeholder="" required>
							</div>
							<div class="form-group col-md-3">
								<label><h6>Valor de QInfra</label></h6>
								<input type="text" name="qtde_infra" id="qtde_infra" class="form-control" value="<?php echo $row[0]['qtde_infra']; ?>" placeholder="" required>
							</div>
						</div>	
						<div class="form-group">
							<input type="hidden" name="editId" id="editId" value="<?php echo $_REQUEST['editId']?>">
							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> Atualizar dados</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="card-footer text-muted">
				SIMUEL 
		</div>

	</div>
	<script>

	</script>
      
</body>
</html>