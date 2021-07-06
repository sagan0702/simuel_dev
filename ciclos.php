<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Gerenciar Ciclos</title>
	<?php 
	include_once('php/formatacao.php');
    include ("php/bootstrapalert.php");
	?>
	<?php
        session_start();
        include ("php/conexao.php");
       
        
        
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
	if(isset($_REQUEST['n_ciclo']) and $_REQUEST['n_ciclo']!=""){
		$condition	.=	' AND n_ciclo LIKE "%'.$_REQUEST['n_ciclo'].'%" ';
	}
	if(isset($_REQUEST['data_inicio']) and $_REQUEST['data_inicio']!=""){
		$condition	.=	' AND data_inicio LIKE "%'.$_REQUEST['data_inicio'].'%" ';
	}
	if(isset($_REQUEST['data_fim']) and $_REQUEST['data_fim']!=""){
		$condition	.=	' AND data_fim LIKE "%'.$_REQUEST['data_fim'].'%" ';
	}
	if(isset($_REQUEST['estado']) and $_REQUEST['estado']!=""){
		$condition	.=	' AND estado LIKE "%'.$_REQUEST['estado'].'%" ';
	}
		
	$userData	=	$db->getAllRecords('ciclo','*',$condition,'ORDER BY id_ciclo DESC');
	?>
   	<div class="container">
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
			<h3>Gerenciar Ciclos</h3>
				<!-- <i class="fa fa-fw fa-globe"></i> <strong>Pequisar </strong>  -->
				<a href="php/ciclo_add.php" class="float-left btn btn-dark btn-lg"> 
				<i class="fa fa-fw fa-plus-circle"></i>  Adicionar Ciclo</a></div> <!--- BOTÃO DE AÇÃO -->
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
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Ciclos Cadastrados </h5>
			<table class="table table-striped table-bordered table-sm">
				<thead>
					<tr class="bg-secondary text-white">
						<td style="text-align: center;" >#</td>
						<td style="text-align: center;" >Ciclo</td>
						<td style="text-align: center;" >Data de Inicio</td>
						<td style="text-align: center;" >Data de Término</td>
						<td style="text-align: center;" >Situação</td>
						<td style="text-align: center;" >Data de Atualização</td>
						<td style="text-align: center;" >FP</td>
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
						<?php
						$est = $val['estado'];
							if ($est == 1) {
								$estado = "Ativo";
								} else {
								$estado = "Fechado";
							}
						
						
							$data_atua =  substr($val['data_atualizacao'],0, 10);    
							$data_atua = implode("/",array_reverse(explode("-",$data_atua)));;
						
						?>

						<td style="text-align: center;"><?php echo $s;?></td>
						<td style="text-align: center;" ><?php echo $val['n_ciclo'];?></td>
						<td style="text-align: center;" ><?php echo implode("/",array_reverse(explode("-",$val['data_inicio'])));;?></td>
						<td style="text-align: center;" ><?php echo implode("/",array_reverse(explode("-",$val['data_fim'])));;?></td>
						<td style="text-align: center;"><?php echo $estado;?></td>
						<td style="text-align: center;"><?php echo $data_atua;?></td>
						<td style="text-align: center;"><?php echo $val['fator_prod'];?></td>
						<td align="center">
							<a href="php/ciclo_edit.php?editId=<?php echo $val['id_ciclo'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
							<a href="php/ciclo_delete.php?delId=<?php echo $val['id_ciclo'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a>
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

					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Pesquisar Ciclos </h5>
					<form method="get">
						<div class="row">
								<div class="col-md-1">
									<label> Ciclo</label>
									<input type="text" name="n_ciclo" id="n_ciclo" class="form-control" value="<?php echo isset($_REQUEST['n_ciclo'])?$_REQUEST['n_ciclo']:''?>" placeholder="00/0000" onkeypress="$(this).mask('00/0000')">
								</div>
								<div class="col-sm-2">
									<label>Data de Início</label>
									<input type="date" name="data_inicio" id="data_inicio" class="form-control" value="<?php echo isset($_REQUEST['data_inicio'])?$_REQUEST['data_inicio']:''?>" placeholder="Selecione" >
								</div>
								<div class="col-sm-2">
									<label>Data de Término</label>
									<input type="date" name="data_fim" id="data_fim" class="form-control" placeholder="Selecione" value="<?php echo isset($_REQUEST['data_fim'])?$_REQUEST['data_fim']:''?>" >
								</div>
								<div class="col-sm-1">
									<label>Situação</label>
									<input type="text" name="estado" id="estado" class="form-control"  onkeypress="$(this).mask('0')" value="<?php echo isset($_REQUEST['estado'])?$_REQUEST['estado']:''?>" >
								</div>
								<div class="form-group col-md-1">
									<label p class="text-secondary" ><h6>Situação: 1-Ativo  0-Fechado </label></h6>
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
			<div class="card-footer text-muted">
						SIMUEL 
					</div>
		</div>
	
	</div>

	
</body>
</html>
