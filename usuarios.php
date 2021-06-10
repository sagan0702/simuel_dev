<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Gerenciar Usuários</title>
	<?php include_once('php/formatacao.php');
	
       

        include ("php/conexao.php");
		session_start();
        include ("php/bootstrapalert.php");
        
        $dadosConexao = mysqli_get_host_info($conexao);
            if (!isset($_SESSION["usuario"])) {
                header('Location: index.php');
                exit();
            }
            include($_SESSION['menu']); 
    ?>
</head>
<body>
	<?php
	$condition	=	'';
	if(isset($_REQUEST['usuario']) and $_REQUEST['usuario']!=""){
		$condition	.=	' AND usuario LIKE "%'.$_REQUEST['usuario'].'%" ';
	}
	if(isset($_REQUEST['nome']) and $_REQUEST['nome']!=""){
		$condition	.=	' AND nome LIKE "%'.$_REQUEST['nome'].'%" ';
	}
	if(isset($_REQUEST['acesso']) and $_REQUEST['acesso']!=""){
		$condition	.=	' AND acesso LIKE "%'.$_REQUEST['acesso'].'%" ';
	}
		
	$userData	=	$db->getAllRecords('usuarios','*',$condition,'ORDER BY id_usuario DESC');
	?>
   	<div class="container">
		
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
			<h3>Gerenciar Usuários</h3>
				<!-- <i class="fa fa-fw fa-globe"></i> <strong>Pequisar </strong>  -->
				<a href="php/usuario_add.php" class="float-left btn btn-dark btn-lg"> 
				<i class="fa fa-fw fa-plus-circle"></i>  Adicionar Usuários</a></div> <!--- BOTÃO DE AÇÃO -->
			<div class="card-body"> <!--- MENSAGENS -->
				<?php
				if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rds"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Registro Apagado com sucesso!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rus"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Registro Atualizado com sucesso!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rnu"){
					echo	'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Não foi realizada nenhuma alteração!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
					echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Há alguma coisa errada. <strong>Tente novamente!</strong></div>';
				}
				?>
		<div>   <!--- MOSTRA A TABELA DE REGISTROS  -->
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Usuários Cadastrados </h5>
			<table class="table table-striped table-bordered table-sm">
				<thead>
					<tr class="bg-primary text-white">
						<!-- <td style="text-align: center;" >#</td> -->
						<td style="text-align: center;" >#</td>
						<td style="text-align: center;" >Local</td>
						<td style="text-align: center;" >Usuario</td>
						<td style="text-align: center;" >Nome</td>
						<td style="text-align: center;" >E-mail</td>
						<td style="text-align: center;" >Senha</td>
						<td style="text-align: center;" >Nivel de Acesso</td>
						<td style="text-align: center;" class="text-center">Ação</td>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(count($userData)>0){
						$s	=	'';
						foreach($userData as $val){
							$s++;
					?>
					<tr>
						<!-- <td style="text-align: center;"><?php echo $s;?></td> -->
						<td style="text-align: center;" ><?php echo $val['id_usuario'];?></td>
						<td style="text-align: center;" ><?php echo $val['id_local'];?></td>
						<td style="text-align: center;" ><?php echo $val['usuario'];?></td>
						<td style="text-align: center;" ><?php echo $val['nome'];?></td>
						<td style="text-align: center;"><?php echo $val['email'];?></td>
						<td style="text-align: center;" ><?php echo $val['senha'];?></td>
						<td style="text-align: center;" ><?php echo $val['acesso'];?></td>
						
						
						<!-- <td style="text-align: center;" ><?php echo implode("/",array_reverse(explode("-",$val['data_minima'])));;?></td> -->

						<td align="center">
							<a href="php/usuario_edit.php?editId=<?php echo $val['id_usuario'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
							<a href="php/usuario_delete.php?delId=<?php echo $val['id_usuario'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a>
						</td>

					</tr>
					<?php 
						}
					}else{
					?>
					<tr><td colspan="6" align="center">Nenhum registro encontrado!</td></tr>
					<?php } ?>
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		<div class="col-sm-12"> <!--- CAMPOS DE PESQUISA -->
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Localizar </h5>
					<form method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<label>Nome</label>
									<input type="text" name="nome" id="nome" class="form-control" value="<?php echo isset($_REQUEST['nome'])?$_REQUEST['nome']:''?>" placeholder="Digite o nome">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Nome de Login</label>
									<input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo isset($_REQUEST['usuario'])?$_REQUEST['usuario']:''?>" placeholder="Digite o usuário">
								</div>
							</div>

							<div class="col-sm-2">
								<div class="form-group">
									<label>Nivel de Acesso</label>
									<input type="text" name="acesso" id="acesso" class="form-control" value="<?php echo isset($_REQUEST['acesso'])?$_REQUEST['acesso']:''?>" placeholder="Selecione o nivel de acesso">
								</div>
							</div>

						</div>

						<div class="row">	
							<div class="col-sm-2">
								
								<button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i>Pesquisar</button> 
								
							</div>
							<div class="col-sm-2">
									<a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i>Limpar</a>
							</div>


						</div>
					</form>
				</div>
			</div>
		</div>
		<hr>  <!--- FIM DO FORM DE PESQUISA -->
	</div>

	<script>
	
	</script>
</body>
</html>
