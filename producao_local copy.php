<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Produção Local</title>
	<style>
	#n_ciclo{
        background-color:whitesmoke;
        color: #585858;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        padding: 0, 0, 0, 0;
    }
	#n_os{
        background-color:whitesmoke;
        color: #585858;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        padding: 0, 0, 0, 0;
    }
</style>
	<?php 
	include_once('php/formatacao.php');
	include_once('php/consulta_ciclo_os.php');
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
	 if(isset($_REQUEST['dt_envio']) and $_REQUEST['dt_envio']!=""){
	 	$condition	.=	' AND dt_envio LIKE "%'.$_REQUEST['dt_envio'].'%" ';
	 }
	 if(isset($_REQUEST['n_os']) and $_REQUEST['nome']!=""){
	 	$condition	.=	' AND nome LIKE "%'.$_REQUEST['nome'].'%" ';
	 }
		$ids_local = $_SESSION['id_local'];
		//echo $id_local;
		$condition =	"AND id_local =".$ids_local;
		$userData	=	$db->getAllRecords('producao','*',$condition,'ORDER BY id_producao DESC');
		//print_r($userData);
		// teste
		//include_once('php/status_update.php');
	?>
   	<div class="container">
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
			<h3>Produção Local</h3>
				<!-- <i class="fa fa-fw fa-globe"></i> <strong>Pequisar </strong>  -->
				<a href="php/producao_local_add.php" class="float-left btn btn-dark btn-lg"> 
				<i class="fa fa-fw fa-plus-circle"></i>  Adicionar Produção</a></div> 
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
		<?php
        include ("php/conexao.php");
		// session_start();
        include ("php/bootstrapalert.php");
    	?>
				<div class="row">
							<div class="form-group col-md-4" >
									<label><h6>Ciclo atual: 
									<div id="n_ciclo"><?= $_SESSION['max_n_ciclo'] ?></div></h5></label>
							</div>
							<div class="form-group col-md-4" >
									<label><h6>Nº da OS:  <div id ="n_os"> <?= $_SESSION['max_n_os'] ?>  </div></h6></label>
									
							</div>
			</div>    
		<!--------------- FORM TABELA 1 REGISTRO DE PRODUCAO ENVIADA -------------------->
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Registro de Produção Enviada </h5>
			<table class="table table-striped table-bordered -sm table-sm">
				<thead>
					<tr class="bg-secondary text-white">
						<td style="text-align: center;" >#</td>
						<td style="text-align: center;" >Data</td>
						<td style="text-align: center;" >Hora</td>
						<td style="text-align: center;" >UE2009</td>
						<td style="text-align: center;" >UE2010</td>
						<td style="text-align: center;" >UE2011</td>
						<td style="text-align: center;" >UE2013</td>
						<td style="text-align: center;" >UE2015</td>
						<td style="text-align: center;" >UE2020</td>
						<td style="text-align: center;" >UE2022</td> 
						<td style="text-align: center;" >Total de UEs</td>
						<td style="text-align: center;" >UEs SEM chamado</td>
						<td style="text-align: center;" >UEs COM chamado</td>
						<td style="text-align: center;" >BAT reserva</td>
						<td style="text-align: center;" >BAT substituídas </td>
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
							$totue2009 = $val['ue2009p']; 
                            $totue2010 = $val['ue2010p']; 
                            $totue2011 = $val['ue2011p'];
                            $totue2013 = $val['ue2013p'];
                            $totue2015 = $val['ue2015p'];
                            $totue2020 = $val['ue2020p'];
                            $totue2022 = $val['ue2022p'];
					?>
					<tr>
						<?php
							$data =  substr($val['dt_envio'],0, 10);    
							$data2 = implode("/",array_reverse(explode("-",$data)));;
							$hora =  substr($val['dt_envio'],10, 9);  
						
							$tot_ue = $totue2009 + $totue2010 + $totue2011 + $totue2013 + $totue2015 + $totue2020 + $totue2022;
						?>
						<td style="text-align: center;"><?php echo $s;?></td> 
						<td style="text-align: center;" ><?php echo $data2;?></td> 
						<td style="text-align: center;" ><?php echo $hora;?></td> 
						<td style="text-align: center;" ><?php echo $val['ue2009p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2010p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2011p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2013p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2015p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2020p'];?></td>
						<td style="text-align: center;" ><?php echo $val['ue2022p'];?></td> 
						<td style="text-align: center;" ><?php echo $tot_ue ?></strong></td>
						<td style="text-align: center;" ><?php echo $val['nue_sem_chamado'];?></td>
						<td style="text-align: center;" ><?php echo $val['nue_com_chamado'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_reserva'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_subst'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_vazando'];?></td>
						<td style="text-align: center;" ><?php echo $val['bat_oxidada'];?></td>
						<td align="center">
							<!-- <a href="php/producao_local_edit.php?editId=<?php echo $val['id_producao'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> |  -->
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
		<!-- </div>  -->
		<div class="col-sm-12"> 
<!--------------- FORM TABELA 2  TABELA DE STATUS - RESUMO PARTE 1 - URNAS -------------------->
	<?php

	$ids_local = $_SESSION['id_local'];
	$condition =	"AND id_local =".$ids_local;
	$userData	=	$db->getAllRecords('status','*',$condition,'ORDER BY id_local');
	?>
	<br>
			<h5 class="card-title"><i class="fa fa-th-list"></i></i> Resumo Total Manutenção Preventiva (dados comulativos) </h5>
			 <!-- <div class="row">
				<div class="form-group col-md-9">
				<br><label>Data do último envio: </label> <? $data2; ?> 
				</div>
        	</div> -->
			<table class="table table-striped table-bordered -sm table-sm">
			<caption>Atenção: dados cumulativos</caption>
				<thead>
					<tr class="bg-secondary text-white">
						<td style="text-align: center;" >UE2009</td>
						<td style="text-align: center;" >UE2010</td>
						<td style="text-align: center;" >UE2011</td>
						<td style="text-align: center;" >UE2013</td>
						<td style="text-align: center;" >UE2015</td>
						<td style="text-align: center;" >UE2020</td>
						<td style="text-align: center;" >UE2022</td>
						<td style="text-align: center;" >Total de UE</td>
						<td style="text-align: center;" >Total da OS</td>
						<td style="text-align: center;" >% Concluído da OS</td>
					<!-- <td style="text-align: center;" class="text-center">Ação</td> -->
					</tr>
				</thead>
				<tbody>
					<?php 
					if(count($userData)>0){
						$s	=	'';
						foreach($userData as $val){
							$s++;
							$stue2009 = $val['totue2009']; 
                            $stue2010 = $val['totue2010']; 
                            $stue2011 = $val['totue2011'];
                            $stue2013 = $val['totue2013'];
                            $stue2015 = $val['totue2015'];
                            $stue2020 = $val['totue2020'];
                            $stue2022 = $val['totue2022'];
					?>
					<tr>
						<?php
							$data =  substr($val['data_atualizacao'],0, 10);    
							$data2 = implode("/",array_reverse(explode("-",$data)));;
							$tot_ue = $stue2009 + $stue2010 + $stue2011 + $stue2013 + $stue2015 + $stue2020 + $stue2022;

							// total da urnas da OS max
							$sql = "SELECT MAX(id_os), n_os, t_urnas FROM os WHERE id_local = $ids_local";
							$result2 = mysqli_query($conexao,$sql);
							$row = mysqli_fetch_row($result2);
							$t_urna_os = $row[2];
							
							//calcular o percentual
							$perc_tot =  ($tot_ue * 100) / $t_urna_os;
							$perc_tot_st = number_format($perc_tot, 1);
						?>
						<td style="text-align: center;" ><strong><?php echo $val['totue2009'];?></strong></td>
						<td style="text-align: center;" ><strong><?php echo $val['totue2010'];?></strong></td>
						<td style="text-align: center;" ><strong><?php echo $val['totue2011'];?></strong></td>
						<td style="text-align: center;" ><strong><?php echo $val['totue2013'];?></strong></td>
						<td style="text-align: center;" ><strong><?php echo $val['totue2015'];?></strong></td>
						<td style="text-align: center;" ><strong><?php echo $val['totue2020'];?></strong></td>
						<td style="text-align: center;" ><strong><?php echo $val['totue2022'];?></strong></td>
						<td class="table-success" style="text-align: center;" ><strong><?php echo $tot_ue ?></strong></td>
						<td style="text-align: center;" ><strong><?php echo $t_urna_os ?></strong></td>
						<td class="table-success" style="text-align: center;" ><strong><?php echo $perc_tot_st."%"?></strong></td>
												<!-- <td align="center"> -->
							<!-- <a href="php/producao_local_edit.php?editId=<?php echo $val['id_producao'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> |  -->
							<!-- <a href="php/producao_local_delete.php?delId=<?php echo $val['id_producao'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a> -->
						<!-- </td> -->
					</tr>
					<?php 
						}
					}else{
					?>
					<tr><td colspan="6" align="center">Nenhum registro encontrado!</td></tr>
					<?php } ?>
				</tbody>
			</table>
			<!---//////////////////////////////////////// -->
			<h5 class="card-title"><i class="fa fa-th-list"></i></i> Resumo Total: Manutenção Corretiva (dados cumulativos) </h5>
			 <!-- <div class="row">
				<div class="form-group col-md-9">
				<br><label>Data do último envio: </label> <? $data2; ?> 
				</div>
        	</div> -->
			<table class="table table-striped table-bordered -sm table-sm">
			<caption>Atenção: dados cumulativos</caption>
				<thead>
					<tr class="bg-secondary text-white">
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
						<td style="text-align: center;" ><?php echo $val['tnue_sem_chamado'];?></td>
						<td style="text-align: center;" ><?php echo $val['tnue_com_chamado'];?></td>
						<td style="text-align: center;" ><?php echo $val['tbat_reserva'];?></td>
						<td style="text-align: center;" ><?php echo $val['tbat_subst'];?></td>
						<td style="text-align: center;" ><?php echo $val['tbat_vazando'];?></td>
						<td style="text-align: center;" ><?php echo $val['tbat_oxidada'];?></td>
						<!-- <td align="center"> -->
							<!-- <a href="php/producao_local_edit.php?editId=<?php echo $val['id_producao'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> |  -->
							<!-- <a href="php/producao_local_delete.php?delId=<?php echo $val['id_producao'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a> -->
						<!-- </td> -->
					</tr>
					<?php 
						}
					}else{
					?>
					<tr><td colspan="6" align="center">Nenhum registro encontrado!</td></tr>
					<?php } ?>
				</tbody>
			</table>
			<!---//////////////////////////////////////// -->
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
