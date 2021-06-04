<?php include_once('config.php');
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($usuario==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un');
		exit;
	}elseif($nome==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue');
		exit;
	}elseif($senha==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');
		exit;
	}else{
		
		//converter para data br -> data mysql
		
		$userCount	=	$db->getQueryCount('usuarios','id_usuario');
		if($userCount[0]['total']<20){
			$data	=	array(
							'id_local'=>$id_local,
							'usuario'=>$usuario,
							'nome'=>$nome,
							'email'=>$email,
							'senha'=>$senha,
							'acesso'=>$acesso,

						);
			$insert	=	$db->insert('usuarios',$data);
			if($insert){
				header('location:/simuel/usuarios.php?msg=ras');
				exit;
			}else{
				header('location:/simuel/usuarios.php?msg=rna');
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
	<title>Adicionar Usuários</title>
  	<?php include_once('formatacao.php');?>
</head>
<body>

	<!--- MENSAGENS -->
   	<div class="container">
		<h3>Adicionar Usuário</h3>
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
			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Adicionar Ciclo</strong> 
				<a href="/simuel/usuarios.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar Usuários</a>
			</div>
			<div class="card-body">		
				<div class="col-sm-6">
					<h5 class="card-title">Campos <span class="text-danger">*</span> são obrigatórios!</h5>
					<form method="post">
						<div class="row">
							
								<div class="form-group col-md-6">
										<label>Local <span class="text-danger">*</span></label>
										<input type="text" name="id_local" id="id_local" class="form-control" 
										placeholder="" /> 
								</div>
						</div>


						<div class="row">
								<div class="form-group col-md-6 ">
									<label>Usuário</label>
									<input type="text" class="form-control" name="usuario" id="usuario" />
								</div>
								<div class="form-group col-md-12">
									<label for="campo4">Nome Completo:</label>
									<input type="text" class="form-control" name="nome" id="nome" />
								</div>
								<div class="form-group col-md-6">
									<label for="campo4">E-mail:</label>
									<input type="text" class="form-control" name="email" id="email" />
								</div>
								<div class="form-group col-md-6">
									<label for="campo4">Senha:</label>
									<input type="text" class="form-control" name="senha" id="senha" />
								</div>
								<div class="form-group col-md-6">
									<label for="campo4">Nível de acesso:</label>
									<input type="text" class="form-control" name="acesso" id="acesso" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Adicionar</button>
								</div>
							</div>	
						
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="container my-4">	
	</div>
 
	<script>
		
		
	</script>
</body>
</html>