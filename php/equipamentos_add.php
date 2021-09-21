<?php include_once('config.php');
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($tipo==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un');
		exit;
	}elseif($modelo==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue');
		exit;
	}elseif($descricao==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');
		exit;
	}else{
		
		//converter para data br -> data mysql

		$em_garantia = $_POST['garantia'];
		$fim_garantia = implode("-",array_reverse(explode("/",$fim_garantia)));
	
			if($userCount[0]['total']<20){
			$data	=	array(
						'tipo'=>$tipo,
						'modelo'=>$modelo,
						'descricao'=>$descricao,
						'fabricante'=>$fabricante,
						'tipo_bateria'=>$tipo_bateria,
						'em_garantia'=>$em_garantia,
						'fim_garantia'=>$fim_garantia,
						);
			$insert	=	$db->insert('equipamentos',$data);
			if($insert){
				header('location:/simuel/equipamentos.php?msg=ras');
				exit;
			}else{
				header('location:/simuel/equipamentos.php?msg=rna');
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
	<title>Adicionar Equipamento</title>
  	<?php include_once('formatacao.php');?>
</head>
<body>

	<!--- MENSAGENS -->
   	<div class="container">
		<h3>Adicionar Equipamento</h3>
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
			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Adicionar Equipamento</strong> 
				<a href="/simuel/equipamentos.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar Equipamentos</a>
			</div>
			<div class="card-body">		
				<div class="col-sm-6">
					
					<form method="post">
						
					<form method="post">
						<div class="form-group col-md-2">
							<label><h6>Tipo:</label></h6>
							<input type="text" name="tipo" id="tipo" class="form-control" value="" placeholder="" required>
						</div>
						<div class="form-group col-md-4">
							<label><h6>Modelo:</label></h6>
							<input type="text" name="modelo" id="modelo" class="form-control" value="" placeholder="" required>
						</div>
						<div class="form-group col-md-12">
							<label><h6>Descrição:</label></h6>
							<input type="text" name="descricao" id="descricao" class="form-control" value="" placeholder="" required>
						</div>
						<div class="form-group col-md-4">
							<label><h6>Fabricante:</label></h6>
							<input type="text" name="fabricante" id="fabricante" class="form-control" value="" placeholder="" required>
						</div>
						<div class="form-group col-md-4">
							<label><h6>Tipo de Bateria:</label></h6>
							<input type="text" name="tipo_bateria" id="tipo_bateria" class="form-control" value="" placeholder=""  required>
						</div>
						<br>
						<div class="form-group"> <!--- ADD RADIO --->
							<label><h6>Em garantia?</label></h6>
						
							<div class="form-check">
							<input class="form-check-input" type="radio" name="garantia" value="SIM" id="radio_garantia_sim" checked>
							<label class="form-check-label" for="flexRadioDefault1">
								Sim
							</label>
							</div>
							<div class="form-check">
							<input class="form-check-input" type="radio" name="garantia" value="NÃO" id="radio_garantia_nao" >
							<label class="form-check-label" for="flexRadioDefault2">
								Não
							</label> 
							</div>
							<br>
						<div class="form-group col-md-6">
							
							<label><h6>Data do fim da Garantia:</label></h6>
							<input type="text" name="fim_garantia" id="fim_garantia" class="form-control" value=""  required>						
						</div>

						</div>

						<br>
						<div class="row ">
							<div class="form-group col-md-6">
								<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Adicionar Equipamento</button>

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
		$('#fim_garantia').datepicker({	
			format: "yyyy/mm/dd",	
			language: "pt-BR",
			startDate: '+0d',
			
		});
		
	
		
		
	</script>
</body>
</html>