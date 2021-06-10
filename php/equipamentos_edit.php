<?php include_once('config.php');
if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
	$row	=	$db->getAllRecords('equipamentos','*',' AND id_equip="'.$_REQUEST['editId'].'"');
}

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($tipo==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un&editId='.$_REQUEST['editId']);
		exit;
	}elseif($modelo==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue&editId='.$_REQUEST['editId']);
		exit;
	}elseif($descricao==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up&editId='.$_REQUEST['editId']);
		exit;
	}
	$fim_garantia = implode("-",array_reverse(explode("/",$fim_garantia)));
	

	$data	=	array(
					'tipo'=>$tipo,
					'modelo'=>$modelo,
					'descricao'=>$descricao,
					'fabricante'=>$fabricante,
					'tipo_bateria'=>$tipo_bateria,
					'em_garantia'=>$em_garantia,
					'fim_garantia'=>$fim_garantia,
					);

	$update	=	$db->update('equipamentos',$data,array('id_equip'=>$editId));
	if($update){
		header('location: /simuel/equipamentos.php?msg=rus');
		exit;
	}else{
		header('location: /simuel/equipamentos.php?msg=rnu');
		exit;
	}
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Editar Equipamento</title>
	<?php include_once('formatacao.php');?>
	
</head>

<body>
	
		<!--- MENSAGENS -->
	
   	<div class="container">
		<h2><Editar Equipamento </h2>
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
				<strong><h3>Editar Equipamento</h3></strong><a href="/simuel/equipamentos.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar Equipamentos</a>
			</div>
			<div class="card-body">
				
				<div class="col-sm-6">
					

					<form method="post">
						<div class="form-group">
							<label><h6>Tipo</label></h6>
							<input type="text" name="tipo" id="tipo" class="form-control" value="<?php echo $row[0]['tipo']; ?>" placeholder="" required>
						</div>
						<div class="form-group">
							<label><h6>Modelo</label></h6>
							<input type="text" name="modelo" id="modelo" class="form-control" value="<?php echo $row[0]['modelo']; ?>" placeholder="" required>
						</div>
						<div class="form-group">
							<label><h6>Descrição</label></h6>
							<input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $row[0]['descricao']; ?>" placeholder="" required>
						</div>
						<div class="form-group">
							<label><h6>Fabricante</label></h6>
							<input type="text" name="fabricante" id="fabricante" class="form-control" value="<?php echo $row[0]['fabricante']; ?>" placeholder="" required>
						</div>
						<div class="form-group">
							<label><h6>Tipo de Bateria</label></h6>
							<input type="text" name="tipo_bateria" id="tipo_bateria" class="form-control" value="<?php echo $row[0]['tipo_bateria']; ?>" placeholder=""  required>
						</div>
						<div class="form-group">
							<label><h6>Em garantia?</label></h6>
							<input type="text" name="em_garantia" id="em_garantia" class="form-control" value="<?php echo $row[0]['em_garantia']; ?>" placeholder="" required>
						</div>
						<div class="form-group col-md-6">
							<?php
							$datai = $row[0]['fim_garantia'];
							$datai= implode("/",array_reverse(explode("-",$datai))); 
							?>
							<label><h6>Fim da Garantia </label></h6>
							<input type="text" name="fim_garantia" id="fim_garantia" class="form-control" value="<?php 
							echo $datai ?>"  required>						
						</div>

						
						</div>	
						
						<div class="form-group">
							<input type="hidden" name="editId" id="editId" value="<?php echo $_REQUEST['editId']?>">
							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> Atualizar dados</button>
						</div>
					</form>
				</div>
			</div>
			<div class="card-footer text-muted">
				SIMUEL 
			</div>
		
		</div>
		

	</div>

	<script>
		$('#fim_garantia').datepicker({	
			format: "yyyy/mm/dd",
			language: "pt-BR",
			startDate: 'datai',
		
		});
	
	</script>
      
</body>
</html>