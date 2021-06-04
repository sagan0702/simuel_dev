<?php include_once('config.php');
if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
	$row	=	$db->getAllRecords('os','*',' AND id_os="'.$_REQUEST['editId'].'"');
}

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($n_ciclo==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un&editId='.$_REQUEST['editId']);
		exit;
	}elseif($data_inicio==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue&editId='.$_REQUEST['editId']);
		exit;
	}elseif($data_fim==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up&editId='.$_REQUEST['editId']);
		exit;
	}
	$data_inicio = implode("-",array_reverse(explode("/",$data_inicio)));
	$data_fim = implode("-",array_reverse(explode("/",$data_fim)));

	$data	=	array(
					'n_ciclo'=>$n_ciclo,
					'data_inicio'=>$data_minima,
					'data_fim'=>$data_maxima,
					'estado'=>$estado,
					);
	$update	=	$db->update('os',$data,array('id_os'=>$editId));
	if($update){
		header('location: /simuel/os.php?msg=rus');
		exit;
	}else{
		header('location: /simuel/os.php?msg=rnu');
		exit;
	}
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Editar OS</title>
	<?php include_once('formatacao.php');?>
	
</head>

<body>
	
		<!--- MENSAGENS -->
	
   	<div class="container">
		<h2><Editar OS </h2>
		<?php
		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="un"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ue"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="up"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo é obrigatório!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){
			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i>  Item inserido com sucesso!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Item NÃO inserido!<strong>Tente novamente!</strong></div>';
		}
		?>
							<!-- converter para data br -> data mysql
							$data_inicio = implode("-",array_reverse(explode("/",$data_inicio)));
							$data_fim = implode("-",array_reverse(explode("/",$data_fim))); -->


							<!-- connverter data mysql -> data BR
       						$data_inicio = implode("/",array_reverse(explode("-",$data_inicio)));
       						$data_fim = implode("/",array_reverse(explode("-",$data_fim))); -->


		<!--- CAMPOS DE EDITAR -->
		<div class="card">  
			<div class="card-header">
				<!-- <i class="fa fa-fw fa-plus-circle"></i> -->
				<strong><h3>Editar OS</h3></strong><a href="/simuel/os.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar OS</a>
			</div>
			<div class="card-body">
				
				<div class="col-sm-6">
					<h3 class="card-title"><h5>Campos com<span class="text-danger">*</span> são obrigatórios!</h5>
					<form method="post">
						<div class="form-group">
							<label><h6>Nº da OS<span class="text-danger">*</span></label></h6>
							<input type="text" name="n_os" id="n_os" class="form-control" value="<?php echo $row[0]['n_os']; ?>" placeholder="" onkeypress="$(this).mask('00/0000')" required>
						</div>

						<div class="row">
							<div class="form-group col-md-6">
								<?php
								$datai = $row[0]['data_minima'];
								$datai= implode("/",array_reverse(explode("-",$datai))); 
								?>
								<label><h6>Data Mínima <span class="text-danger">*</span></label></h6>
								<input type="text" name="data_minima" id="data_minima" class="form-control" value="<?php 
								echo $datai ?>" placeholder="" required>
								
								
								
							</div>
							<div class="form-group col-md-6">
								<?php
								$dataf = $row[0]['data_maxima'];
								$dataf= implode("/",array_reverse(explode("-",$dataf))); 
								?>
								<label><h6>Data Máxima <span class="text-danger">*</span></label></h6>
								<input type="text" name="data_maxima" id="data_maxima" maxlength="12" class="form-control" value="<?php echo $dataf ?>" placeholder="" required>

								
							</div>
						</div>
						<div class="row">



						</div>
						





						<div class="form-group">
							<label><h6>Estado <span class="text-danger">*</span></label></h6>
							<input type="text" name="estado" id="estado" maxlength="12" class="form-control" value="<?php echo $row[0]['estado']; ?>" placeholder="" required>
						</div>
						<div class="form-group">
							<input type="hidden" name="editId" id="editId" value="<?php echo $_REQUEST['editId']?>">
							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> Atualizar dados</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>



	    <script>
		$('#data_minima').datepicker({	
			format: "yyyy/mm/dd",
			language: "pt-BR",
			startDate: 'datai',
		
		});
		
	
		

		$('#data_maxima').datepicker({	
				
			format: "yyyy/mm/dd",
			language: "pt-BR",
			startDate: '+0d',
			
		});
		
		
	</script>
      
</body>
</html>