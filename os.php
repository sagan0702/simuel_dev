<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Gerenciar Ordens de Serviço</title>
	<?php include_once('php/formatacao.php');
	
	
	
	
	
	
	?>
	





</head>
<body>
	<?php
	$condition	=	'';
	if(isset($_REQUEST['n_ciclo']) and $_REQUEST['n_ciclo']!=""){
		$condition	.=	' AND n_ciclo LIKE "%'.$_REQUEST['n_ciclo'].'%" ';
	}
	if(isset($_REQUEST['n_os']) and $_REQUEST['n_os']!=""){
		$condition	.=	' AND n_os LIKE "%'.$_REQUEST['n_os'].'%" ';
	}
	if(isset($_REQUEST['data_minima']) and $_REQUEST['data_minima']!=""){
		$condition	.=	' AND data_minima LIKE "%'.$_REQUEST['data_minima'].'%" ';
	}
	if(isset($_REQUEST['data_maxima']) and $_REQUEST['data_maxima']!=""){
		$condition	.=	' AND data_maxima LIKE "%'.$_REQUEST['data_maxima'].'%" ';
	}
	if(isset($_REQUEST['situacao']) and $_REQUEST['situacao']!=""){
		$condition	.=	' AND situacao LIKE "%'.$_REQUEST['situacao'].'%" ';
	}
		
	$userData	=	$db->getAllRecords('os','*',$condition,'ORDER BY id_ciclo DESC');
	?>
   	<div class="container">
		<h3>Gerenciar OS</h3>
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
				<!-- <i class="fa fa-fw fa-globe"></i> <strong>Pequisar </strong>  -->
				<a href="php/os_add.php" class="float-left btn btn-dark btn-lg"> 
				<i class="fa fa-fw fa-plus-circle"></i>  Adicionar OS</a></div> <!--- BOTÃO DE AÇÃO -->
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
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Ordens de Serviço Cadastradas </h5>
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="bg-primary text-white">
						<!-- <th style="text-align: center;" >#</th> -->
						<th style="text-align: center;" >Local</th>
						<th style="text-align: center;" >Ciclo</th>
						<th style="text-align: center;" >OS</th>
						<th style="text-align: center;" >Data Mínima</th>
						<th style="text-align: center;" >Data Máxima</th>
						<th style="text-align: center;" >Situação</th>
						<th style="text-align: center;" >Dias_Off</th>
						<th style="text-align: center;" >Total de Urnas</th>
						<th style="text-align: center;" >Total de Baterias</th>
						<th style="text-align: center;" >Total de QGA</th>
						<th style="text-align: center;" >Total de Dias Disponiveis</th>
						<th style="text-align: center;" >Total de UST</th>
						<th style="text-align: center;" class="text-center">Ação</th>
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
						<td style="text-align: center;" ><?php echo $val['id_local'];?></td>
						<td style="text-align: center;" ><?php echo $val['id_ciclo'];?></td>
						<td style="text-align: center;" ><?php echo $val['n_os'];?></td>
						<td style="text-align: center;" ><?php echo implode("/",array_reverse(explode("-",$val['data_minima'])));;?></td>
						<td style="text-align: center;" ><?php echo implode("/",array_reverse(explode("-",$val['data_maxima'])));;?></td>
						<td style="text-align: center;"><?php echo $val['situacao'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_dias_off'];?></td>
						<td style="text-align: center;" ><?php echo $val['t_urnas'];?></td>
						<td style="text-align: center;" ><?php echo $val['t_baterias'];?></td>
						<td style="text-align: center;"><?php echo $val['t_urnas'] + $val['t_baterias'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_dias_disp'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ust'];?></td>
						
						

						<td align="center">
							<a href="php/os_edit.php?editId=<?php echo $val['id_os'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
							<a href="php/os_delete.php?delId=<?php echo $val['id_os'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a>
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
									<label> OS</label>
									<input type="text" name="n_os" id="n_os" class="form-control" value="<?php echo isset($_REQUEST['n_os'])?$_REQUEST['n_os']:''?>" placeholder="Digite o número da OS no formato 00/0000" onkeypress="$(this).mask('00/0000')">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Data Mínima</label>
									<input type="date" name="data_minima" id="data_minima" class="form-control" value="<?php echo isset($_REQUEST['data_minima'])?$_REQUEST['data_minima']:''?>" placeholder="Selecione a data mínima da OS">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Data Máxima</label>
									<input type="date" name="data_maxima" id="data_maxima" class="form-control" value="<?php echo isset($_REQUEST['data_maxima'])?$_REQUEST['data_maxima']:''?>" placeholder="Selecione a data máxima da OS">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Situação</label>
									<input type="text" name="situacao" id="situacao" class="form-control" value="<?php echo isset($_REQUEST['situacao'])?$_REQUEST['situacao']:''?>" placeholder="Selecione a situação">
								</div>
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
		</div>
		<hr>  <!--- FIM DO FORM DE PESQUISA -->
	</div>

	<script>
		$(document).ready(function() {
			
			var versaoJquery = $.fn.jquery;
			//alert (versaoJquery)
		});
	</script>
</body>
</html>
