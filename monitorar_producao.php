<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Gerenciar Produção</title>
	<?php include_once('php/formatacao.php');?>
</head>
<body>
	<?php
	$condition	=	'';
	if(isset($_REQUEST['dt_envio']) and $_REQUEST['usuario']!=""){
		$condition	.=	' AND usuario LIKE "%'.$_REQUEST['usuario'].'%" ';
	}
	if(isset($_REQUEST['n_os']) and $_REQUEST['nome']!=""){
		$condition	.=	' AND nome LIKE "%'.$_REQUEST['nome'].'%" ';
	}
	
		
	$userData	=	$db->getAllRecords('producao','*',$condition,'ORDER BY id_producao DESC');
	?>
   	<div class="container">
		<h3>Gerenciar Produção</h3>
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
				<!-- <i class="fa fa-fw fa-globe"></i> <strong>Pequisar </strong>  -->
				<a href="php/producao_add.php" class="float-left btn btn-dark btn-lg"> 
				<i class="fa fa-fw fa-plus-circle"></i>  Adicionar Produção</a></div> <!--- BOTÃO DE AÇÃO -->
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

		<!-- `id_producao`, `idciclo`, `idnvi`, `id_os`, `n_os`, `dt_envio`, `ue2009p`, `ue2010p`, `ue2011p`, `ue2013p`, `ue2015p`, `ue2020p`, `ue2022p`, `miv2022p`, `nue_sem_chamado`, `nue_com_chamado`, `bat_carga_ok`, `bat_sem_carga`, `bat_vazando`, `bat_oxidada`SELECT * FROM `producao` WHERE 1 -->


		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Urnas com manutenção realizada </h5>
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="bg-primary text-white">
						<!-- <th style="text-align: center;" >#</th> -->
						<th style="text-align: center;" >#</th>
						<th style="text-align: center;" >Data de Envio</th>
						<th style="text-align: center;" >UE2009</th>
						<th style="text-align: center;" >UE2010</th>
						<th style="text-align: center;" >UE2011</th>
						<th style="text-align: center;" >UE2013</th>
						<th style="text-align: center;" >UE2015</th>
						<th style="text-align: center;" >UE2020</th>
						<th style="text-align: center;" >UE2022</th>
					
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
						<td style="text-align: center;" ><?php echo implode("/",array_reverse(explode("-",$val['dt_envio'])));;?></td> 
						<td style="text-align: center;" ><?php echo $val['ue2009p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2010p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2011p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2013p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2015p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2020p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2022p'];?></td>
						
						
						

						<td align="center">
							<a href="php/producao_edit.php?editId=<?php echo $val['id_producao'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
							<a href="php/producao_delete.php?delId=<?php echo $val['id_producao'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a>
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


		<!--------------- FORM TABELA 2 -------------------->

		
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Produção Geral </h5>
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="bg-primary text-white">
						<!-- <th style="text-align: center;" >#</th> -->
						<th style="text-align: center;" >#</th>
						<th style="text-align: center;" >Nº de Urnas SEM chamado</th>
						<th style="text-align: center;" >Nº de Urnas COM chamado</th>
						<th style="text-align: center;" >Nº de baterias Com carga OK</th>
						<th style="text-align: center;" >Nº de baterias Sem carga </th>
						<th style="text-align: center;" >Nº de baterias com vazamento </th>
						<th style="text-align: center;" >Nº de baterias oxidadas</th>
						<th style="text-align: center;" >Observações</th>
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

					<!-- `id_producao`, `idciclo`, `idnvi`, `id_os`, `n_os`, `dt_envio`, `ue2009p`, `ue2010p`, `ue2011p`, `ue2013p`, `ue2015p`, `ue2020p`, `ue2022p`, `miv2022p`, `nue_sem_chamado`, `nue_com_chamado`, `bat_carga_ok`, `bat_sem_carga`, `bat_vazando`, `bat_oxidada`SELECT * FROM `producao` WHERE 1 -->
		
						
						<td style="text-align: center;" ><?php echo $val['nue_sem_chamado'];?></td>
						<td style="text-align: center;" ><?php echo $val['nue_com_chamado'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_carga_ok'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_sem_carga'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_vazando'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_oxidada'];?></td>
						<td style="text-align: center;" ><?php echo $val['observacao'];?></td>
									
						

						<td align="center">
							<a href="php/producao_edit.php?editId=<?php echo $val['id_producao'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
							<a href="php/producao_delete.php?delId=<?php echo $val['id_producao'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a>
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












		<!--------------- FIM DO FORM TABELA 2 -------------------->


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
		$(document).ready(function() {
			
			var versaoJquery = $.fn.jquery;
			//alert (versaoJquery)
		});
	</script>
</body>
</html>
