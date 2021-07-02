<?php include_once('config.php');
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($codigo==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un');
		exit;
	}elseif($descricao==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue');
		exit;
	}elseif($estoque_atual==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');
		exit;
	}else{
		
		//converter para data br -> data mysql
		
		$userCount	=	$db->getQueryCount('pecas','id_peca');
		// if($userCount[0]['total']<50){
			$data	=	array(
							'codigo'=>$codigo,
							'descricao'=>$descricao,
							'critica'=>$critica,
							'especializada'=>$especializada,
							'modeloUE'=>$modeloUE,
							'estoque_atual'=>$estoque_atual,
							'estoque_minimo'=>$estoque_minimo,
							'imagem'=>$imagem,
						);
			$insert	=	$db->insert('pecas',$data);
			if($insert){
				header('location:/simuel/pecas.php?msg=ras');
				exit;
			}else{
				header('location:/simuel/pecas.php?msg=rna');
				exit;
			}
		// }else{
		// 	header('location:'.$_SERVER['PHP_SELF'].'?msg=dsd');
		// 	exit;
		// }
	}
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Adicionar Peça de Urna</title>
  	<?php include_once('formatacao.php');

	?>
</head>
<body>

	<!--- MENSAGENS -->
   	<div class="container">
		
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
		// }elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="dsd"){
		// 	echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Please delete and then try again <strong>We set limit for security reasons!</strong></div>';
		}

		?>

		<div class="card">   <!---CARD ADICIONAR --->
			<div class="card-header">
			<h3>Adicionar Peça de Urna</h3>
			<!-- <i class="fa fa-fw fa-plus-circle"></i> <strong>Adicionar Ciclo</strong>  -->
				<a href="/simuel/pecas.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Peças de Urna</a>
			</div>
			<div class="card-body">		
				<div class="col-sm-6">
					
					<form method="post">
						<div class="row">
							<div class="col-md-2 ">
								<label>Código </label>
								<input type="text" name="codigo" id="codigo" class="form-control" 
								placeholder="" onkeypress="$(this).mask('000-0')" required/> 
							</div>
		
							<div class="col-md-10 ">
								<label>Descrição</label>
								<input type="text" class="form-control" name="descricao" id="descricao" required />
							</div>
						</div> 

						<div class="row">
							<div class="col-md-2 ">
								<label for="campo4">Peça Crítica:</label>
								<input type="text" class="form-control" name="critica" id="critica" required/>
							</div>

							<div class="col-md-2 ">
								<label for="campo4">Peça Especializada?</label>
								<input type="text" class="form-control" name="especializada" id="especializada" required/>
							</div>
						</div> 						
					
						<div class="row">

							<div class="col-md-2 ">
								<label>Modelo de Urna </label>
								<input type="text" name="modeloUE" id="modeloUE" class="form-control" 
								placeholder=""  required/> 
							</div>
		
							<div class="col-md-2 ">
								<label>Estoque Atual</label>
								<input type="text" class="form-control" name="estoque_atual" id="estoque_atual" required />
							</div>

							<div class="col-md-2 ">
								<label>Estoque Mínimo</label>
								<input type="text" class="form-control" name="estoque_minimo" id="estoque_minimo" required />
							</div>

						</div> 
						<div class="row">

						<div class="col-md-3 ">
								<label>Imagem</label>
								<input type="text" class="form-control" name="imagem" id="imagem" required />
							</div>

						</div> 
					  	<br>

						<div class="row ">
							<div class="form-group">
								<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Adicionar Peça</button>

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