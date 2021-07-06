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
		$userCount	=	$db->getQueryCount('ciclo','id_ciclo');
		if($userCount[0]['total']<20){
			$data	=	array(
							'n_ciclo'=>$n_ciclo,
							'data_inicio'=>$data_inicio,
							'data_fim'=>$data_fim,
							'estado'=>$estado,
							'fator_prod'=>$fator_prod,
						);
			$insert	=	$db->insert('ciclo',$data);
			if($insert){
				header('location:/simuel/ciclos.php?msg=ras');
				exit;
			}else{
				header('location:/simuel/ciclos.php?msg=rna');
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
	<title>Adicionar Ciclo</title>
  	<?php include_once('formatacao.php');


	// $sql = "SELECT  FROM status ORDER BY id_local";
	// 		$result2 = mysqli_query($conexao,$sql);
	// 		$row = mysqli_fetch_row($result2);
	// 		$ue2009_prod = $row[0];

	// ?>
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
			<h3>Adicionar Ciclo</h3>
			<!-- <i class="fa fa-fw fa-plus-circle"></i> <strong>Adicionar Ciclo</strong>  -->
				<a href="/simuel/ciclos.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar Ciclos</a>
			</div>
			<div class="card-body">		
				<div class="col-sm-6">
					
					<form method="post">
						<div class="row">
							<div class="col-md-3 ">
								<label>Nº do Ciclo </label>
								<input type="text" name="n_ciclo" id="n_ciclo" class="form-control" 
								placeholder="" onkeypress="$(this).mask('00/0000')" required/> 
							</div>
						</div>
						<div class="row">
								<div class="col-md-3 ">
									<label>Data de Início</label>
									<input type="text" class="form-control" name="data_inicio" id="data_inicio" required />
								</div>
								<div class="col-md-3 ">
									<label for="campo4">Data de Término:</label>
									<input type="text" class="form-control" name="data_fim" id="data_fim" required/>
								</div>
						</div> 
						<div class="row">
								<div class="col-md-3 ">
									<label>Fator de Produção</label>
									<input type="text" class="form-control" name="fator_prod" id="fator_prod" onkeypress="$(this).mask('000')" required />
								</div>
						</div> 
						<div class="form-group">
							<label></label>
							<input type="hidden" name="estado" id="estado"  value = "1" required>
						</div>
						<div class="row ">
							<div class="form-group">
								<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Adicionar Ciclo</button>

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