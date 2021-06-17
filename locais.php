<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Gerenciar Locais</title>
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
	if(isset($_REQUEST['local']) and $_REQUEST['local']!=""){
		$condition	.=	' AND  local  LIKE "%'.$_REQUEST['local'].'%" ';
	}
	if(isset($_REQUEST['sede']) and $_REQUEST['sede']!=""){
		$condition	.=	' AND sede LIKE "%'.$_REQUEST['sede'].'%" ';
	}
			
	$userData	=	$db->getAllRecords('local','*',$condition,'ORDER BY id_local DESC');
	?>
   	<div class="container">
	
		
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
			<h3>Gerenciar Locais</h3>
				<!-- <i class="fa fa-fw fa-globe"></i> <strong>Pequisar </strong>  -->
				<a href="php/locais_add.php" class="float-left btn btn-dark btn-lg"> 
				<i class="fa fa-fw fa-plus-circle"></i>  Adicionar Local</a></div> <!--- BOTÃO DE AÇÃO -->
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
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Locais Cadastrados </h5>
			<table class="table table-striped table-bordered table-sm">
				<thead>
					<!-- `id_local`, `n_local`, `sede`, `qtde_ue2009`, `qtde_ue2010`, `qtde_ue2011`, `qtde_ue2013`,
							`qtde_ue2015`, `qtde_ue2020`, `qtde_ue2022`, `qtde_miv_2022`, `qtde_baterias`, `data_atualizacao`, `qtde_infra` -->


					<tr class="bg-secondary text-white">
						<td style="text-align: center;" >#</td>
						<td style="text-align: center;" >Localidade</td>
						<td style="text-align: center;" >Sede</td>
						<td style="text-align: center;" >Nº de UE2009</td>
						<td style="text-align: center;" >Nº de UE2010</td>
						<td style="text-align: center;" >Nº de UE2011</td>
						<td style="text-align: center;" >Nº de UE2013</td>
						<td style="text-align: center;" >Nº de UE2015</td>
						<td style="text-align: center;" >Nº de UE2020</td>
						<td style="text-align: center;" >Nº de UE2022</td>
						<td style="text-align: center;" >Nº de Baterias Reserva</td>
						<td style="text-align: center;" >QInfra</td>
						<!-- <td style="text-align: center;" class="text-center">Ação</td> -->
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
						<td style="text-align: center;"><?php echo $val['n_local'];?></td>
						<td style="text-align: center;"><?php echo $val['sede'];?></td>
						<td style="text-align: center;"><?php echo $val['qtde_ue2009'];?></td>
						<td style="text-align: center;"><?php echo $val['qtde_ue2010'];?></td>
						<td style="text-align: center;"><?php echo $val['qtde_ue2011'];?></td>
						<td style="text-align: center;"><?php echo $val['qtde_ue2013'];?></td>
						<td style="text-align: center;"><?php echo $val['qtde_ue2015'];?></td>
						<td style="text-align: center;"><?php echo $val['qtde_ue2020'];?></td>
						<td style="text-align: center;"><?php echo $val['qtde_ue2022'];?></td>
						<td style="text-align: center;"><?php echo $val['qtde_baterias'];?></td>
						<td style="text-align: center;"><?php echo $val['qtde_infra'];?></td>
						
						<td align="center">
							<a href="php/locais_edit.php?editId=<?php echo $val['id_local'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
							<a href="php/locais_delete.php?delId=<?php echo $val['id_local'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a>
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
									<label> Local</label>
									<input type="text" name="n_local" id="n_local" class="form-control" value="<?php echo isset($_REQUEST['n_local'])?$_REQUEST['n_local']:''?>" >
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Sede</label>
									<input type="date" name="sede" id="sede" class="form-control" value="<?php echo isset($_REQUEST['sede'])?$_REQUEST['sede']:''?>" >
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
			<div class="card-footer text-muted">
						SIMUEL 
					</div>
		</div>
	
	</div>

	<script>
		
	</script>
</body>
</html>
