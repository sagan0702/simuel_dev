
<?php include_once('config.php');
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($n_ciclo==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un');
		exit;
	}elseif($data_inicio==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue');
		exit;
	}elseif($data_fim==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');
		exit;
	}else{
	
		//converter para data br -> data mysql
		$data_inicio = implode("-",array_reverse(explode("/",$data_inicio)));
		$data_fim = implode("-",array_reverse(explode("/",$data_fim)));
		$userCount	=	$db->getQueryCount('pecas_req','id_req');
		if($userCount[0]['total']<20){
			$data	=	array(
					'id_local'=>$id_local,
					'id_peca'=>$id_peca,
					'codigo'=>$codigo,
					'data'=>$data,
					'id_usuario'=>$id_usuario,
					'quant_solicitada'=>$quant_solicitada,
						);
			$insert	=	$db->insert('pecas_req',$data);
			if($insert){
				header('location:/simuel_dev/pecas.php?msg=ras');
				exit;
			}else{
				header('location:/simuel_dev/pecass.php?msg=rna');
				exit;
			}
		}else{
			header('location:'.$_SERVER['PHP_SELF'].'?msg=dsd');
			exit;
		}
	}
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Solicitar Peças</title>
 <?php 
 include_once('formatacao.php');


	

 ?>
</head>
<body>

	<!--- MENSAGENS // COLOCAR O VALOR DO FP DIARIO DENTRO DO CADASTRO DE CICLOS  -->
	
   	<div class="container">
		
		<?php  
		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="un"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ue"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="up"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){
			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Item inserido com sucesso!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Item NÃO inserido! <strong>Tente novamente!</strong></div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="dsd"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Please delete and then try again <strong>We set limit for security reasons!</strong></div>';
		}

		?>

		<div class="card">   <!---CARD ADICIONAR --->
			<div class="card-header">
			<h3>Solicitar Peças de Urna</h3>
			<!-- <i class="fa fa-fw fa-plus-circle"></i> <strong>Adicionar Ciclo</strong>  -->
				<a href="/simuel_dev/pecas.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar Peças</a>
			</div>
			<div class="card-body">		
				<div class="col">
					<form method="post">
						<div class="row">
							<div class="col-md-1 ">
								<label>Código </label>
								<input type="text" name="codigo" id="codigo" class="form-control" 
								placeholder="" onkeypress="$(this).mask('0000')" required/> 
							</div>
					
								<div class="col-md-6 ">
									<label>Nome da Peça</label>
									<input type="text" class="form-control" name="descricao" id="descricao" required />
								</div>
								<div class="col-md-1 ">
									<label>Quantidade</label>
									<input type="text" class="form-control" name="quantidade" id="quantidade" onkeypress="$(this).mask('000')" required />
								</div>
								<div class="col-md-4">
								<button type="submit" name="submit" value="" id="" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Adicionar Peça</button>

							</div>
						</div> 


						<div class="form-group">
							<label></label>
							<input type="hidden" name="estado" id="estado"  value = "1" required>
						</div>
						
						<br>
						<div class="form-group">
								<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Fazer requisição</button>

						</div>
					
					</form>
				</div>
			
			</div>
			<div class="card-footer text-muted">
				SIMUEL 
		</div>
		</div>
	</div>
	<div class="container my-4">	
	</div>
 
	<script>
		$('#data_inicio').datepicker({	
			format: "yyyy/mm/dd",	
			language: "pt-BR",
			startDate: '+0d',
			
		});
		
		$('#data_fim').datepicker({	
				
			format: "yyyy/mm/dd",
			language: "pt-BR",
			startDate: '+0d',
			onSelect: function addDiasOff (date) {
            inicio = $('#data_inicio').val();
            fim = $('#data_fim').val();
            if (fim < inicio) {
                alert(` Data  ${date} INVÁLIDO. A data selecionada é menor que o inicio do período!`);
            } else {

			}
		}

		});
		
		
	</script>
</body>
</html>



























--------------------------------------------------------------------------------------------------------------------



<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Solicitar Peças de Urna</title>
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
	

	// `id_req`, `id_local`, `id_peca`, `codigo`, `data`, `id_usuario`, `quant_solicitada`, `quant_legal`, `quant_fornecida`SELECT * FROM `pecas_req`



	$userCount	=	$db->getQueryCount('pecas_req','id_req');
	// if($userCount[0]['total']<50){
		$data	=	array(
						'id_local'=>$id_local,
						'id_peca'=>$id_peca,
						'codigo'=>$codigo,
						'data'=>$data,
						'id_usuario'=>$id_usuario,
						'quant_solicitada'=>$quant_solicitada,
						
					);
		$insert	=	$db->insert('pecas',$data);
		if($insert){
			header('location:/simuel_dev/pecas.php?msg=ras');
			exit;
		}else{
			header('location:/simuel_dev/pecas.php?msg=rna');
			exit;
		}


	$userData	=	$db->getAllRecords('pecas_req','*',$condition,'ORDER BY id_req DESC');
	?>
   	<div class="container">
			
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
				<h3>Solicitar Peças de Urna</h3>
					<!-- <i class="fa fa-fw fa-globe"></i> <strong>Pequisar </strong>  -->
				
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
				

				<!--- FORM DE SOLICITAÇÃO -->		

						<div class="row">
							
							<div class="col-md-2">
								<label for="urna09">COD:</label>
								<input type="text" class="form-control" name="codigo" id="codigo" value="0" onkeypress="$(this).mask('000-0')" onfocusout="totalUrna()">
							</div>
							<div class="col-md-2 ">
								<label for="urna10">Nome da Peça</label>
								<input type="text" class="form-control" name="descricao" id="descricao" value="0"   >
							</div>
							<div class="col-md-2 ">
								<label for="urna11">Quantidade solicitada:</label>
								<input type="text" class="form-control"  name="ue2011p" id="ue2011p" value="0" onkeypress="$(this).mask('0000')" >
							</div>
							
						</div>		

		   <!-- MOSTRA A TABELA DE REGISTROS -->
			<h5 class="card-title"><i class="fa fa-th-list"></i></i> Lista de Peças  </h5>
				<table class="table table-striped table-bordered table-sm">
					<thead>
						<tr class="bg-secondary text-white">
							<td style="text-align: center;" >#</td>
							<td style="text-align: center;" >Código</td>
							<td style="text-align: center;" >Quantidade</td>
							<td style="text-align: center;" >Crítica</td>
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
							<td style="text-align: center;" ><?php echo $val['quant_solicitada'];?></td>
							<td style="text-align: center;" ><?php echo $val['estoque_minimo'];?></td>
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
