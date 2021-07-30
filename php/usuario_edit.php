<?php include_once('config.php');
if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
	$row	=	$db->getAllRecords('usuarios','*',' AND id_usuario="'.$_REQUEST['editId'].'"');
}

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($usuario==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un&editId='.$_REQUEST['editId']);
		exit;
	}elseif($nome==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue&editId='.$_REQUEST['editId']);
		exit;
	}elseif($email==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up&editId='.$_REQUEST['editId']);
		exit;
	}


	$data	=	array(
					'id_local'=>$id_local,
					'usuario'=>$usuario,
					'nome'=>$nome,
					'email'=>$email,
					'senha'=>$senha,
					'acesso'=>$acesso,
					);
	$update	=	$db->update('usuarios',$data,array('id_usuario'=>$editId));
	if($update){
		header('location: /simuel_dev/usuarios.php?msg=rus');
		exit;
	}else{
		header('location: /simuel_dev/usuarios.php?msg=rnu');
		exit;
	}
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Editar Usuário</title>
	<?php include_once('formatacao.php');?>
	
</head>

<body>
	
		<!--- MENSAGENS -->
	
   	<div class="container">
		<h2>Editar Usuário </h2>
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
				<strong><h3>Editar Usuário</h3></strong><a href="/simuel/usuarios.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar Usuários</a>
			</div>
			<div class="card-body">
				
				<div class="col-sm-6">
					<h3 class="card-title"><h5>Campos com<span class="text-danger">*</span> são obrigatórios!</h5>
					<form method="post">

					<div class="form-group ">

						<div class="row">
								
									<div class="form-group col-md-6">
											<label>Local <span class="text-danger">*</span></label>
											<input type="text" name="id_local" value="<?php echo $row[0]['id_local'];?>" id="id_local" class="form-control" placeholder="" required>
									</div>
							</div>

						<div class="row">
									<div class="form-group col-md-6 ">
										<label>Usuário</label>
										<input type="text" class="form-control" value="<?php echo $row[0]['usuario']; ?>" name="usuario" id="usuario" >
									</div>
									<div class="form-group col-md-12">
										<label for="campo4">Nome Completo:</label>
										<input type="text" class="form-control" value="<?php echo $row[0]['nome']; ?>"  name="nome" id="nome" />
									</div>
									<div class="form-group col-md-6">
										<label for="campo4">E-mail:</label>
										<input type="text" class="form-control" value="<?php echo $row[0]['email']; ?>"  name="email" id="email" />
									</div>
									<div class="form-group col-md-6">
										<label for="campo4">Senha:</label>
										<input type="text" class="form-control" value="<?php echo $row[0]['senha']; ?>" name="senha" id="senha" />
									</div>
									<div class="form-group col-md-6">
										<label for="campo4">Nível de acesso:</label>
										<input type="text" class="form-control"  value="<?php echo $row[0]['acesso']; ?>" name="acesso" id="acesso" />
									</div>
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
	</script>
    
</body>
</html>