<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Peças de Urna</title>
	<?php 

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
	if(isset($_REQUEST['codigo']) and $_REQUEST['codigo']!=""){
		$condition	.=	' AND codigo LIKE "%'.$_REQUEST['codigo'].'%" ';
	}
	if(isset($_REQUEST['descricao']) and $_REQUEST['descricao']!=""){
		$condition	.=	' AND descricao LIKE "%'.$_REQUEST['descricao'].'%" ';
	}
	if(isset($_REQUEST['modeloUE']) and $_REQUEST['modeloUE']!=""){
		$condition	.=	' AND modeloUE LIKE "%'.$_REQUEST['modeloUE'].'%" ';
	}
	
		
	$userData	=	$db->getAllRecords('pecas','*',$condition,'ORDER BY id_peca DESC');
	?>
   	<div class="container">
			
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
				<h3>Gerenciar Peças</h3>
					<!-- <i class="fa fa-fw fa-globe"></i> <strong>Pequisar </strong>  -->
					<a href="php/pecas_add.php" class="float-left btn btn-dark btn-lg"> 
					<i class="fa fa-fw fa-plus-circle"></i>  Adicionar Peças</a></div> <!--- BOTÃO DE AÇÃO -->
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

						<!-- CAMPOS DE PESQUISA -->
						<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Localizar </h5>
							<form method="get">
								<div class="row">
									<div class="col-sm-1">
										<div class="form-group">
											<label> Código</label>
											<input type="text" name="codigo" id="codigo" class="form-control" value="<?php echo isset($_REQUEST['codigo'])?$_REQUEST['tipo']:''?>" placeholder="" onkeypress="$(this).mask('0000-0')">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Descrição</label>
											<input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo isset($_REQUEST['descricao'])?$_REQUEST['descricao']:''?>" >
										</div>
									</div>
									<div class="col-sm-1">
										<div class="form-group">
											<label>ModeloUE</label>
											<input type="text" name="modeloUE" id="modeloUE" class="form-control" value="<?php echo isset($_REQUEST['modeloUE'])?$_REQUEST['modeloUE']:''?>" >
										</div>
									</div>
								</div>
								<br>
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
				

		   <!-- MOSTRA A TABELA DE REGISTROS -->
			<h5 class="card-title"><i class="fa fa-th-list"></i></i> Equipamentos Cadastrados </h5>
				<table class="table table-striped table-bordered table-sm">
					<thead>
						<tr class="bg-secondary text-white">
							<td style="text-align: center;" >#</td>
							<td style="text-align: center;" >Código</td>
							<td style="text-align: center;" >Descrição</td>
							<td style="text-align: center;" >Crítica</td>
							<td style="text-align: center;" >Especializada</td>
							<td style="text-align: center;" >Modelo UE</td>
							<td style="text-align: center;" >Estoque Atual</td>
							<td style="text-align: center;" >Estoque Mínimo</td>
							<td style="text-align: center;" >Imagem</td>
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
							<td style="text-align: center;" ><?php echo $val['codigo'];?></td>
							<td style="text-align: center;"><?php echo $val['descricao'];?></td>
							<td style="text-align: center;" ><?php echo $val['critica'];?></td>
							<td style="text-align: center;"><?php echo $val['especializada'];?></td>
							<td style="text-align: center;" ><?php echo $val['modeloUE'];?></td>
							<td style="text-align: center;" ><?php echo $val['estoque_atual'];?></td>
							<td style="text-align: center;" ><?php echo $val['estoque_minimo'];?></td>
							<td style="text-align: center;" ><?php echo $val['imagem'];?></td>
							<td align="center">
								<a href="php/pecas_edit.php?editId=<?php echo $val['id_peca'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
								<a href="php/pecas_delete.php?delId=<?php echo $val['id_peca'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a>
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
		
				</div>	
				
				<div class="card-footer text-muted">
							SIMUEL 
				</div>
			
		
	</div>


</body>
</html>
