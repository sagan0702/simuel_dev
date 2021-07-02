<?php include_once('config.php');
if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
	$row	=	$db->getAllRecords('pecas','*',' AND id_peca="'.$_REQUEST['editId'].'"');
}

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($codigo==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un&editId='.$_REQUEST['editId']);
		exit;
	}elseif($descricao==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue&editId='.$_REQUEST['editId']);
		exit;
	}elseif($estoque_atual==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up&editId='.$_REQUEST['editId']);
		exit;
	}

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
	$update	=	$db->update('pecas',$data,array('id_peca'=>$editId));
	if($update){
		header('location: /simuel/pecas.php?msg=rus');
		exit;
	}else{
		header('location: /simuel/pecas.php?msg=rnu');
		exit;
	}
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Editar Peça de Urna</title>
	<?php include_once('formatacao.php');?>
	
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
			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i>  Item inserido com sucesso!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Item NÃO inserido!<strong>Tente novamente!</strong></div>';
		}
		?>
						

		<!--- CAMPOS DE EDITAR -->
		<div class="card">  
			<div class="card-header">
				<!-- <i class="fa fa-fw fa-plus-circle"></i> -->
				<strong><h3>Editar Peça</h3></strong><a href="/simuel/pecas.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar Peças</a>
			</div>
			<div class="card-body">
				<div class="col-sm-6">
				<form method="post">
					<h3>Editar Peça de Urna</h3>
					<a href="/simuel/pecas.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Peças de Urna</a>
				</div>
			
		
				<!-- <div class="card-body">		 -->
			
					
					<form method="post">
						<div class="row">
							<div class="col-md-2 ">
								<label>Código </label>
								<input type="text" name="codigo" id="codigo" class="form-control" 
								placeholder="" onkeypress="$(this).mask('000-0')" value="<?php echo $row[0]['codigo']; ?>" required/> 
							</div>
		
							<div class="col-md-10 ">
								<label>Descrição</label>
								<input type="text" class="form-control" name="descricao" id="descricao" value="<?php echo $row[0]['descricao']; ?>" required />
							</div>
						</div> 

						<div class="row">
							<div class="col-md-2 ">
								<label for="campo4">Peça Crítica:</label>
								<input type="text" class="form-control" name="critica" id="critica" value="<?php echo $row[0]['critica']; ?>" required/>
							</div>

							<div class="col-md-2 ">
								<label for="campo4">Peça Especializada?</label>
								<input type="text" class="form-control" name="especializada" id="especializada" value="<?php echo $row[0]['especializada']; ?>" required/>
							</div>
						</div> 						
					
						<div class="row">

							<div class="col-md-2 ">
								<label>Modelo de Urna </label>
								<input type="text" name="modeloUE" id="modeloUE" class="form-control" 
								placeholder=""  value="<?php echo $row[0]['modeloUE']; ?>" required/> 
							</div>
		
							<div class="col-md-2 ">
								<label>Estoque Atual</label>
								<input type="text" class="form-control" name="estoque_atual" id="estoque_atual"  value="<?php echo $row[0]['estoque_atual']; ?>" required />
							</div>

							<div class="col-md-2 ">
								<label>Estoque Mínimo</label>
								<input type="text" class="form-control" name="estoque_minimo" id="estoque_minimo" value="<?php echo $row[0]['estoque_minimo']; ?>" required />
							</div>

						</div> 
						<div class="row">

							<div class="col-md-3 ">
								<label>Imagem</label>
								<input type="text" class="form-control" name="imagem" id="imagem" value="<?php echo $row[0]['imagem']; ?>" required />
							</div>

						</div> 
					  	<br>
						

						<!-- <div class="form-check">
							<fieldset>
								<legend>Estado</legend>   
								<input type = "radio" name="r_estado" id="r_estado" value = "1" checked />
								<label for = "dobro">Aberto</label>   
								<input type = "radio" name="r_estado" id="r_estado" value = "0" />
								<label for = "cubo">Fechado</label>
							</fieldset>
						</div> -->


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


	<script>
	
		
	</script>
       
</body>
</html>