<?php include_once('config.php');
if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
	$row	=	$db->getAllRecords('ciclo','*',' AND id_ciclo="'.$_REQUEST['editId'].'"');
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
					'data_inicio'=>$data_inicio,
					'data_fim'=>$data_fim,
					'estado'=>$estado,
					);
	$update	=	$db->update('ciclo',$data,array('id_ciclo'=>$editId));
	if($update){
		header('location: /simuel/ciclos.php?msg=rus');
		exit;
	}else{
		header('location: /simuel/ciclos.php?msg=rnu');
		exit;
	}
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Editar Grupos de Atividades - GA</title>
	<?php include_once('formatacao.php');?>
	
</head>

<body>
	
		<!--- MENSAGENS -->
	
   	<div class="container">
		<h2>Configurar Grupos de Atividades - GA </h2>
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
						


		<!--- CAMPOS DE EDITAR -->
		<div class="card">  
			<div class="card-header">
				<!-- <i class="fa fa-fw fa-plus-circle"></i> -->
			
				<a href="os_add.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Retornar para OS</a>
			</div>
			<div class="card-body">
				
					<form method="post">
						<div class="form-group">
							<div class="row justify-content-sm-center">

								<div class="col-4"> 
									<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="ga651" checked>
										<label class="form-check-label" for="flexCheckDefault">
										6.5.1-Recarregar as baterias internas das urnas eletrônicas
										</label>
										</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga652" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.5.2-Medir a carga das baterias
										</label>
									</div>
									<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="ga653" checked>
										<label class="form-check-label" for="flexCheckDefault">
										6.5.3-Recarregar as baterias de reposição
										</label>
										</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga654" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.5.4-Exercitar os componentes internos e realizar testes funcionais, utilizando o STE
										</label>
									</div>
									<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="ga655" checked>
										<label class="form-check-label" for="flexCheckDefault">
										6.5.5-Promover a limpeza dos gabinetes e dos cabos
										</label>
										</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga656" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.5.6-Separar as urnas para manutenção corretiva
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga657" checked>
										<label class="form-check-label" for="flexCheckDefault">
										6.5.7-Realizar Testes de Aceite nas urnas novas
										</label>
										</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga658" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.5.8-Realizar testes funcionais nas urnas para diversos fins
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga659" checked>
										<label class="form-check-label" for="flexCheckDefault">
										6.5.9-Atualizar o software embarcado das urnas eletrônicas
										</label>
										</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga6510" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.5.10-Instalar a certificação digital
										</label>
									</div>	

								</div>
								<div class="col-4">
									
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga6511" checked>
										<label class="form-check-label" for="flexCheckDefault">
										6.5.11-Retirar as mídias armazenadas nas urnas (Flash Card e/ou Memória de Resultado-MR')
										</label>
										</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga6512" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.5.12-Remover os lacres de eleição
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga6513" checked>
										<label class="form-check-label" for="flexCheckDefault">
										6.5.13-Identificar e substituir as peças não especialistas faltantes ou danificadas
										</label>
										</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga6514" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.5.14-Inserir os dados sobre as urnas eletrônicas manutenidas nos sistemas LogusWeb, STE, Aceitus e outros
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga6515" checked>
										<label class="form-check-label" for="flexCheckDefault">
										6.5.15-Anotar os dados de conservação em caso de indisponibilidade do sistema/equipamento
										</label>
										</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga6516" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.5.16-Verificar degradação dos LCDs
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga6517" checked>
										<label class="form-check-label" for="flexCheckDefault">
										6.5.17-Verificar ocorrência de manchas no protetor acrílico do display do TE (modelo 2009)
										</label>
										</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga6518" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.5.18-Vistoria e separação de urnas por motivos diversos dentro do local de armazenamento
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga6519" checked>
										<label class="form-check-label" for="flexCheckDefault">
										6.5.19-Extrair dados de flashcards em sistema da Justiça Eleitoral
										</label>
										</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga6520" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.5.20-Executar testes exaustivos de hardware nas urnas eletrônicas durante simulados de votação
										</label>
									</div>
								</div>
								<div class="col-4">
									
									<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="ga651" checked>
										<label class="form-check-label" for="flexCheckDefault">
										6.6.1-Organizar o local de armazenamento
										</label>
										</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga662" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.6.2-Movimentar as urnas eletrônicas de e para as bancadas para a manutenção preventiva
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga663" checked>
										<label class="form-check-label" for="flexCheckDefault">
										6.6.3-Verificar a infraestrutura do local de armazenamento e preencher o formulário CheckList do Local de Armazenamento, do sistema LogusWeb
										</label>
										</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga664" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.6.4-Medir a temperatura e umidade do ar do local de armazenamento, utilizando o Termo Higrômetro disponibilizado pela Justiça Eleitoral
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga665" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.6.5-Receber e conferir os suprimentos, as baterias e as bobinas para as urnas eletrônicas

										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="ga666" checked>
										<label class="form-check-label" for="flexCheckChecked">
										6.6.6-Remover as etiquetas das mídias retiradas das urnas após as eleições oficiais, retirando o excesso de sujeira das mesmas
									</div>
								</div>
							
							</div>
						</form>
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