<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Status</title>
	<?php include_once('php/formatacao.php');?>
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
	if(isset($_REQUEST['id_local']) and $_REQUEST['id_local']!=""){
		$condition	.=	' AND id_local LIKE "%'.$_REQUEST['id_local'].'%" ';
	}

	
		
	$userData	=	$db->getAllRecords('status','*',$condition,'ORDER BY id_local ');
	
	?>
   	<div class="container">
		
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
			
			
			<div class="card-body"> <!--- MENSAGENS -->
			<h3>Status da Produção Semanal do STE</h3>
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
			<!-- <div>   -->

			<h5 class="card-title"><i class="fa fa-th-list"></i></i> Total de Urnas com manutenção realizada por Local </h5>
					<table class="table table-striped table-bordered table-sm">
						<thead>
							<tr class="bg-secondary text-white">
								<td style="text-align: center;" >Localidade</td>		
								<td style="text-align: center;" >Data de Envio</td>
								<td style="text-align: center;" >UE2009</td>
								<td style="text-align: center;" >UE2010</td>
								<td style="text-align: center;" >UE2011</td>
								<td style="text-align: center;" >UE2013</td>
								<td style="text-align: center;" >UE2015</td>
								<td style="text-align: center;" >UE2020</td>
								<td style="text-align: center;" >UE2022</td>
								<td style="text-align: center;" >Total Urnas</td>
								<td style="text-align: center;" >UEs SEM chamado</td>
								<td style="text-align: center;" >UEs COM chamado</td>
								<td style="text-align: center;" >BAT Com carga OK</td>
								<td style="text-align: center;" >BAT Sem carga </td>
								<td style="text-align: center;" >BAT com vazamento </td>
								<td style="text-align: center;" >BAT oxidadas</td>
								<td style="text-align: center;" class="text-center">Ação</td>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(count($userData)>0){
								$s	=	'';
								foreach($userData as $val){
									$s++;
									$stotue2009 = $val['totue2009']; 
									$stotue2010 = $val['totue2010']; 
									$stotue2011 = $val['totue2011'];
									$stotue2013 = $val['totue2013'];
									$stotue2015 = $val['totue2015'];
									$stotue2020 = $val['totue2020'];
									$stotue2022 = $val['totue2022'];
							?>
							<tr>
								
								<?php
								$id_loc = $val['id_local'];
								$sql = "SELECT n_local FROM local WHERE id_local = '$id_loc' ";
								$result = mysqli_query($conexao,$sql);
								$row = mysqli_fetch_row($result);
								$local = $row[0];
								//var_dump($local) ;
								$data =  substr($val['data_atualizacao'],0, 10);   
								$data2 = implode("/",array_reverse(explode("-",$data)));;
								$stot_urna = $stotue2009 + $stotue2010 + $stotue2011 + $stotue2013 +$stotue2015 + $stotue2020 + $stotue2022;
								?>
								<td style="text-align: center;" ><?php echo $local ?></td>
								<td style="text-align: center;" ><?php echo $data2 ?></td> 
								<td style="text-align: center;" ><?php echo $val['totue2009'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2010'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2011'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2013'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2015'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2020'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2022'];?></td>
								<td style="text-align: center;" ><?php echo $stot_urna;?></td>
								<td style="text-align: center;" ><?php echo $val['tnue_sem_chamado'];?></td>
								<td style="text-align: center;" ><?php echo $val['tnue_com_chamado'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_carga_ok'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_sem_carga'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_vazando'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_oxidada'];?></td>
								<td align="center" >
									<a href="php/status_edit.php?editId=<?php echo $val['id_local'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i>Limpar </a>  
									<!-- <a href="php/status_delete.php?delId=<?php echo $val['id_local'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i></a> -->
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


					//////////


					<h5 class="card-title"><i class="fa fa-th-list"></i></i> Total de Urnas com manutenção realizada por Local </h5>
					<table class="table table-striped table-bordered table-sm">
						<thead>
							<tr class="bg-secondary text-white">
								<td style="text-align: center;" >Localidade</td>		
								<td style="text-align: center;" >Data de Envio</td>
								<td style="text-align: center;" >UE2009</td>
								<td style="text-align: center;" >UE2010</td>
								<td style="text-align: center;" >UE2011</td>
								<td style="text-align: center;" >UE2013</td>
								<td style="text-align: center;" >UE2015</td>
								<td style="text-align: center;" >UE2020</td>
								<td style="text-align: center;" >UE2022</td>
								<td style="text-align: center;" >Total Urnas</td>
								<td style="text-align: center;" >UEs SEM chamado</td>
								<td style="text-align: center;" >UEs COM chamado</td>
								<td style="text-align: center;" >BAT Com carga OK</td>
								<td style="text-align: center;" >BAT Sem carga </td>
								<td style="text-align: center;" >BAT com vazamento </td>
								<td style="text-align: center;" >BAT oxidadas</td>
								<td style="text-align: center;" class="text-center">Ação</td>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(count($userData)>0){
								$s	=	'';
								foreach($userData as $val){
									$s++;
									$stotue2009 = $val['totue2009']; 
									$stotue2010 = $val['totue2010']; 
									$stotue2011 = $val['totue2011'];
									$stotue2013 = $val['totue2013'];
									$stotue2015 = $val['totue2015'];
									$stotue2020 = $val['totue2020'];
									$stotue2022 = $val['totue2022'];
							?>
							<tr>
								
								<?php
								$id_loc = $val['id_local'];
								$sql = "SELECT n_local FROM local WHERE id_local = '$id_loc' ";
								$result = mysqli_query($conexao,$sql);
								$row = mysqli_fetch_row($result);
								$local = $row[0];
								//var_dump($local) ;
								$data =  substr($val['data_atualizacao'],0, 10);   
								$data2 = implode("/",array_reverse(explode("-",$data)));;
								$stot_urna = $stotue2009 + $stotue2010 + $stotue2011 + $stotue2013 +$stotue2015 + $stotue2020 + $stotue2022;
								?>
								<td style="text-align: center;" ><?php echo $local ?></td>
								<td style="text-align: center;" ><?php echo $data2 ?></td> 
								<td style="text-align: center;" ><?php echo $val['totue2009'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2010'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2011'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2013'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2015'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2020'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2022'];?></td>
								<td style="text-align: center;" ><?php echo $stot_urna;?></td>
								<td style="text-align: center;" ><?php echo $val['tnue_sem_chamado'];?></td>
								<td style="text-align: center;" ><?php echo $val['tnue_com_chamado'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_carga_ok'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_sem_carga'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_vazando'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_oxidada'];?></td>
								<td align="center" >
									<a href="php/status_edit.php?editId=<?php echo $val['id_local'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i>Limpar </a>  
									<!-- <a href="php/status_delete.php?delId=<?php echo $val['id_local'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i></a> -->
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


					////				

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
