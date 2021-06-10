<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Produção Produção</title>
	<?php 

	include_once('php/formatacao.php');
	include_once('php/consulta_ciclo_os.php');
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
	if(isset($_REQUEST['dt_envio']) and $_REQUEST['usuario']!=""){
		$condition	.=	' AND usuario LIKE "%'.$_REQUEST['usuario'].'%" ';
	}
	if(isset($_REQUEST['n_os']) and $_REQUEST['nome']!=""){
		$condition	.=	' AND nome LIKE "%'.$_REQUEST['nome'].'%" ';
	}
	$userData	=	$db->getAllRecords('producao','*',$condition,'ORDER BY id_producao DESC');
	?>

   	<div class="container">
		
		<div class="card"> <!--- FORM DE PESQUISA -->
			
			<div class="card-header">
			<h3>Produção Local</h3>
				<!-- <i class="fa fa-fw fa-globe"></i> <strong>Pequisar </strong>  -->
				<a href="php/producao_local_add.php" class="float-left btn btn-dark btn-lg"> 
				<i class="fa fa-fw fa-plus-circle"></i>  Enviar Produção</a></div> 
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
		
		<?php
        include ("php/conexao.php");
		// session_start();
       
        include ("php/bootstrapalert.php");
    	?>

		<!-- $_SESSION['max_id_ciclo'] = $max_id_ciclo;
		$_SESSION['max_n_ciclo'] = $max_n_ciclo;
		$_SESSION['max_id_os'] = $max_id_os;
		$_SESSION['max_n_os'] = $max_n_os; -->
		
			<div class="row">
							<div class="form-group col-md-4" >
									<label><h6>Ciclo atual: </h5></label>
									<div id="n_ciclo"><?= $_SESSION['max_n_ciclo'] ?></div>
							</div>
							<div class="form-group col-md-4" >
									<label><h6>Nº da OS:  </h6></label>
									<div id ="n_os"> <?= $_SESSION['max_n_os'] ?>  </div>
							</div>
														
			</div>    
		  
		<!--------------- FORM TABELA 1 -------------------->
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Urnas com manutenção realizada </h5>
			<table class="table table-striped table-bordered -sm table-sm">
				<thead>
					<tr class="bg-secondary text-white">
						<!-- <td style="text-align: center;" >#</td> -->
						<td style="text-align: center;" >#</td>
						<td style="text-align: center;" >Data de Envio</td>
						<td style="text-align: center;" >UE2009</td>
						<td style="text-align: center;" >UE2010</td>
						<td style="text-align: center;" >UE2011</td>
						<td style="text-align: center;" >UE2013</td>
						<td style="text-align: center;" >UE2015</td>
						<td style="text-align: center;" >UE2020</td>
						<td style="text-align: center;" >UE2022</td>
						<td style="text-align: center;" >Nº de Urnas SEM chamado</td>
						<td style="text-align: center;" >Nº de Urnas COM chamado</td>
						<td style="text-align: center;" >Nº de baterias Com carga OK</td>
						<td style="text-align: center;" >Nº de baterias Sem carga </td>
						<td style="text-align: center;" >Nº de baterias com vazamento </td>
						<td style="text-align: center;" >Nº de baterias oxidadas</td>
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
							$data =  substr($val['dt_envio'],0, 10);    
							$data2 = implode("/",array_reverse(explode("-",$data)));;

						?>
							
						<td style="text-align: center;"><?php echo $s;?></td> 
						<!-- <td style="text-align: center;" ><?php ?></td>  -->
					
						<td style="text-align: center;" ><?php echo $data2;?></td> 
						<td style="text-align: center;" ><?php echo $val['ue2009p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2010p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2011p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2013p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2015p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2020p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2022p'];?></td>
						<td style="text-align: center;" ><?php echo $val['nue_sem_chamado'];?></td>
						<td style="text-align: center;" ><?php echo $val['nue_com_chamado'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_carga_ok'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_sem_carga'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_vazando'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_oxidada'];?></td>
						<td align="center">
							<a href="php/producao_local_edit.php?editId=<?php echo $val['id_producao'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
							<a href="php/producao_local_delete.php?delId=<?php echo $val['id_producao'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a>
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

		


		<div class="col-sm-12"> <!--- CAMPOS DE PESQUISA -->
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Localizar </h5>
					<form method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<label>Data de Envio</label>
									<input type="text" name="dt_enviop" id="dt_enviop" class="form-control" value="<?php echo isset($_REQUEST['dt_envio'])?$_REQUEST['dt_envio']:''?>" placeholder="Digite a data ">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Ciclo</label>
									<input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo isset($_REQUEST['id_ciclo'])?$_REQUEST['id_ciclo']:''?>" placeholder="Digite o nº do Ciclo">
								</div>
							</div>

							<div class="col-sm-2">
								<div class="form-group">
									<label>Nº da OS</label>
									<input type="text" name="acesso" id="acesso" class="form-control" value="<?php echo isset($_REQUEST['id_os'])?$_REQUEST['id_os']:''?>" placeholder="Digite o nº da OS">
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
