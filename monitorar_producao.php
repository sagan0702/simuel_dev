<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Gerenciar Produção</title>
	<?php include_once('php/formatacao.php');?>
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
	if(isset($_REQUEST['dt_envio']) and $_REQUEST['usuario']!=""){
		$condition	.=	' AND usuario LIKE "%'.$_REQUEST['usuario'].'%" ';
	}
	if(isset($_REQUEST['dt_envio']) and $_REQUEST['nome']!=""){
		$condition	.=	' AND nome LIKE "%'.$_REQUEST['nome'].'%" ';
	}
	
		
	$userData	=	$db->getAllRecords('producao','*',$condition,'ORDER BY id_producao DESC');
	
	?>
   	<div class="container">
		
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
			<h3>Registro de Produção Enviada pelos Locais</h3>
			
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
		<div>  

		<?php
						
						
						// $id_c = $val['id_ciclo'];
						// $sql2 = "SELECT n_ciclo FROM `ciclo` WHERE id_ciclo = $id_c";
						// $result2 = mysqli_query($conexao,$sql2);
						// $row = mysqli_fetch_row($result2);
						// $ciclo = $row[0];
						//var_dump($id_c) ;

							// $est = $val['situacao'];
							// if ($est == 1) {
							// 	$situacao = "Ativa";
							// 	} else {
							// 	$situacao = "Fechada";
							// }
											
						 ?>
		

		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Urnas com manutenção realizada </h5>
			<table class="table table-striped table-bordered table-sm">
				<thead>
					<tr class="bg-secondary text-white">
						<td style="text-align: center;" >Localidade</td>		
						<td style="text-align: center;" >Data de Envio</td>
						<td style="text-align: center;" >Hora</td>
						<td style="text-align: center;" >UE2009</td>
						<td style="text-align: center;" >UE2010</td>
						<td style="text-align: center;" >UE2011</td>
						<td style="text-align: center;" >UE2013</td>
						<td style="text-align: center;" >UE2015</td>
						<td style="text-align: center;" >UE2020</td>
						<td style="text-align: center;" >UE2022</td>
						<td style="text-align: center;" >UEs SEM chamado</td>
						<td style="text-align: center;" >UEs COM chamado</td>
						<td style="text-align: center;" >BAT Reserva</td>
						<td style="text-align: center;" >BAT Substituídas </td>
						<td style="text-align: center;" >BAT com vazamento </td>
						<td style="text-align: center;" >BAT oxidadas</td>
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

						
						<?php
						$id_loc = $val['id_local'];
						$sql = "SELECT n_local FROM local WHERE id_local = '$id_loc' ";
						$result = mysqli_query($conexao,$sql);
						$row = mysqli_fetch_row($result);
						$local = $row[0];
						//var_dump($local) ;
						$data =  substr($val['dt_envio'],0, 10);   
						$data2 = implode("/",array_reverse(explode("-",$data)));;
						$hora =  substr($val['dt_envio'],10, 9);  
						echo $hora;
						?>
						<td style="text-align: center;" ><strong><?php echo $local;?></strong></td>
						<td style="text-align: center;" ><?php echo $data2 ?></td> 
						<td style="text-align: center;" ><?php echo $hora ?></td> 
						<td style="text-align: center;" ><?php echo $val['ue2009p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2010p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2011p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2013p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2015p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2020p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2022p'];?></td>
						<td style="text-align: center;" ><?php echo $val['nue_sem_chamado'];?></td>
						<td style="text-align: center;" ><?php echo $val['nue_com_chamado'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_reserva'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_subst'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_vazando'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_oxidada'];?></td>
						<!-- <td align="center" >
							<a href="php/producao_edit.php?editId=<?php echo $val['id_producao'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i></a>  
							<a href="php/producao_delete.php?delId=<?php echo $val['id_producao'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i></a>
						</td> -->

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

		<!-- </div>  -->

		<div class="col-sm-12"> <!--- CAMPOS DE PESQUISA -->
				<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Localizar </h5>
					<form method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<label>Local</label>
									<input type="text" name="nome" id="nome" class="form-control" value="<?php echo isset($_REQUEST['id_local'])?$_REQUEST['id_local']:''?>" placeholder="">
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
					<div class="card-footer text-muted">
						SIMUEL 
					</div>
	</div>
	<script>
	</script>
</body>
</html>
