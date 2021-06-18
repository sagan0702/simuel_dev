<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Equipamentos</title>
	<?php 

	// session_start();
        
	// if (!isset($_SESSION["usuario"])){
		
	// header('Location: index.php');
	// exit();
		
	// }

	include_once('php/formatacao.php');
    include ("php/bootstrapalert.php");

	?>
	<?php
        session_start();
        include ("php/conexao.php");
        // include ("php/bootstrapalert.php");
        
        
            if (!isset($_SESSION["usuario"])) {
                header('Location: index.php');
                exit();
            }
            include($_SESSION['menu2']); 
    ?>
</head>
<body>
	<?php
	$condition	=	'';
	if(isset($_REQUEST['tipo']) and $_REQUEST['tipo']!=""){
		$condition	.=	' AND tipo LIKE "%'.$_REQUEST['tipo'].'%" ';
	}
	if(isset($_REQUEST['modelo']) and $_REQUEST['modelo']!=""){
		$condition	.=	' AND modelo LIKE "%'.$_REQUEST['modelo'].'%" ';
	}
	if(isset($_REQUEST['em_garantia']) and $_REQUEST['em_garantia']!=""){
		$condition	.=	' AND em_garantia LIKE "%'.$_REQUEST['em_garantia'].'%" ';
	}
	if(isset($_REQUEST['fim_garantia']) and $_REQUEST['fim_garantia']!=""){
		$condition	.=	' AND fim_garantia LIKE "%'.$_REQUEST['fim_garantia'].'%" ';
	}
		
	$userData	=	$db->getAllRecords('equipamentos','*',$condition,'ORDER BY id_equip DESC');
	?>
   	<div class="container">
	
		
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
			<h3>Gerenciar Equipamentos</h3>
				<!-- <i class="fa fa-fw fa-globe"></i> <strong>Pequisar </strong>  -->
				<a href="php/ciclo_add.php" class="float-left btn btn-dark btn-lg"> 
				<i class="fa fa-fw fa-plus-circle"></i>  Adicionar Equipamento</a></div> <!--- BOTÃO DE AÇÃO -->
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
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Equipamentos Cadastrados </h5>
			<table class="table table-striped table-bordered table-sm">
				<thead>
					<tr class="bg-secondary text-white">
						<td style="text-align: center;" >#</td>
						<td style="text-align: center;" >Tipo</td>
						<td style="text-align: center;" >Modelo</td>
						<td style="text-align: center;" >Descrição</td>
						<td style="text-align: center;" >Fabricante</td>
						<td style="text-align: center;" >Tipo Bateria</td>
						<td style="text-align: center;" >Em garantia</td>
						<td style="text-align: center;" >Fim da Garantia</td>
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
						<td style="text-align: center;"><?php echo $s;?></td>
						<td style="text-align: center;" ><?php echo $val['tipo'];?></td>
						<td style="text-align: center;"><?php echo $val['modelo'];?></td>
						<td style="text-align: center;" ><?php echo $val['descricao'];?></td>
						<td style="text-align: center;"><?php echo $val['fabricante'];?></td>
						<td style="text-align: center;" ><?php echo $val['tipo_bateria'];?></td>
						<td style="text-align: center;" ><?php echo $val['em_garantia'];?></td>
						<td style="text-align: center;" ><?php echo $val['fim_garantia'];?></td>
						<td align="center">
							<a href="php/equipamentos_edit.php?editId=<?php echo $val['id_equip'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
							<a href="php/equipamentos_delete.php?delId=<?php echo $val['id_equip'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a>
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
									<label> Tipo</label>
									<input type="text" name="tipo" id="tipo" class="form-control" value="<?php echo isset($_REQUEST['tipo'])?$_REQUEST['tipo']:''?>" placeholder="Digite o ciclo no formato 00/0000" onkeypress="$(this).mask('00/0000')">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Modelo</label>
									<input type="text" name="modelo" id="modelo" class="form-control" value="<?php echo isset($_REQUEST['modelo'])?$_REQUEST['modelo']:''?>" >
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Fim da Garantia</label>
									<input type="date" name="fim_garantia" id="fim_garantia" class="form-control" value="<?php echo isset($_REQUEST['fim_garantia'])?$_REQUEST['fim_garantia']:''?>" >
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Em garantia?</label>
									<input type="text" name="em_garantia" id="em_garantia" class="form-control" value="<?php echo isset($_REQUEST['em_garantia'])?$_REQUEST['em_garantia']:''?>" >
								</div>
							</div>
							<div class="col-sm-2">
								
							</div>

							<div class="col-sm-4">

							</div>
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
			<div class="card-footer text-muted">
						SIMUEL 
					</div>
		</div>
		
	</div>

	
</body>
</html>
