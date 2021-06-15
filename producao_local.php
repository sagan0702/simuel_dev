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
		<!--------------- FORM TABELA 1 -------------------->
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Registro de Produção Enviada </h5>
			<table class="table table-striped table-bordered -sm table-sm">
				<thead>
					<tr class="bg-secondary text-white">
						<td style="text-align: center;" >#</td>
						<td style="text-align: center;" >Data de Envio</td>
						<td style="text-align: center;" >UE2009</td>
						<td style="text-align: center;" >UE2010</td>
						<td style="text-align: center;" >UE2011</td>
						<td style="text-align: center;" >UE2013</td>
						<td style="text-align: center;" >UE2015</td>
						<td style="text-align: center;" >UE2020</td>
						<td style="text-align: center;" >UE2022</td>
						<td style="text-align: center;" >UEs SEM chamado</td>
						<td style="text-align: center;" >UEs COM chamado</td>
						<td style="text-align: center;" >BAT carga OK</td>
						<td style="text-align: center;" >BAT sem carga </td>
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
					?>
					<tr>
						<?php
							$data =  substr($val['dt_envio'],0, 10);    
							$data2 = implode("/",array_reverse(explode("-",$data)));;
						?>
						<td style="text-align: center;"><?php echo $s;?></td> 
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
		<div class="col-sm-12"> <!--- TABELA DE STATUS - RESUMO -->
	<?php
	$local = $_SESSION['id_local'] ;
	$consulta = "SELECT * FROM status WHERE id_local = $local ";
	$con = $conexao->query($consulta) or die($conexao->error); 

	?>
			<h5 class="card-title"><i class="fa fa-fw fa-list"></i> Resumo Total (Produção Cumulativa) </h5>
			<table class="table table-striped table-bordered -sm table-sm">
							<thead>
								<tr class="bg-secondary text-white">
									<td style="text-align: center;" >UE2009</td>
									<td style="text-align: center;" >UE2010</td>
									<td style="text-align: center;" >UE2011</td>
									<td style="text-align: center;" >UE2013</td>
									<td style="text-align: center;" >UE2015</td>
									<td style="text-align: center;" >UE2020</td>
									<td style="text-align: center;" >UE2022</td>
									<td style="text-align: center;" >UEs SEM chamado</td>
									<td style="text-align: center;" >UEs COM chamado</td>
									<td style="text-align: center;" >BAT carga OK</td>
									<td style="text-align: center;" >BAT sem carga </td>
									<td style="text-align: center;" >BAT com vazamento </td>
									<td style="text-align: center;" >BAT oxidadas</td>
								</tr>
							</thead>
							<tbody>
								<?php while($val = $con->fetch_array()) { ?>
								<tr>
									<td style="text-align: center;" ><?php echo $val['totue2009'];?></td>
									<td style="text-align: center;" ><?php echo $val['totue2010'];?></td>
									<td style="text-align: center;" ><?php echo $val['totue2011'];?></td>
									<td style="text-align: center;" ><?php echo $val['totue2013'];?></td>
									<td style="text-align: center;" ><?php echo $val['totue2015'];?></td>
									<td style="text-align: center;" ><?php echo $val['totue2020'];?></td>
									<td style="text-align: center;" ><?php echo $val['totue2022'];?></td>
									<td style="text-align: center;" ><?php echo $val['tnue_sem_chamado'];?></td>
									<td style="text-align: center;" ><?php echo $val['tnue_com_chamado'];?></td>
									<td style="text-align: center;" ><?php echo $val['tbat_carga_ok'];?></td>
									<td style="text-align: center;" ><?php echo $val['tbat_sem_carga'];?></td>
									<td style="text-align: center;" ><?php echo $val['tbat_vazando'];?></td>
									<td style="text-align: center;" ><?php echo $val['tbat_oxidada'];?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>						<!---- fim da tabela de status -->

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
