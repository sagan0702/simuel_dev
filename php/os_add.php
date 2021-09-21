<?php include_once('config.php');
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){

}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Adicionar OS</title>
  	<?php include_once('formatacao.php');
	include("aux_criar_os.php");
    include("conexao.php");
    
    //pega o FP 
    $sql = "SELECT  fator_prod  FROM ciclo";
    $result2 = mysqli_query($conexao,$sql);
	$row = mysqli_fetch_array($result2);
	$fator_prod = $row[0];
    //echo "O fator de produção puxado do banco ciclo é: ".$fator_prod;

    ?>
	<script src="../js/funcaoOS.js"></script> 
    
    <link rel="stylesheet" type="text/css" href="/simuel/css/os_add.css">


</head>
<body>
	<!--- MENSAGENS -->
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
			<h3>Adicionar OS</h3>
				<!-- <i class="fa fa-fw fa-plus-circle"></i> <strong>Adicionar OS</strong>  -->
				<a href="/simuel/os.php" class="float-right btn btn-dark btn-sm">
				<i class="fa fa-fw fa-globe"></i> Gerenciar OS</a>
			</div>
			<div class="card-body">		
				<!-- <div class="col-sm-12"> -->
					<!-- <form method="post">   -->
                    <input type="hidden" id="txt_id_ciclo" value="<?=$id_ciclo?>">
                   
                    <div class="row">
                        <div class="form-group col-md-4" >
                                <label><h5>Ciclo atual: </h5></label>
                                <div id="txt_n_ciclo"><?=$ciclo?></div>
                        </div>
                        <div class="form-group col-md-4" >
                                <label><h6>Período total:  </h6></label>
                                <div id ="p_total" > <?=$periodo?></div>
                        </div>
                        <div class="form-group col-md-1">
                                <label><h6>QInfra : </h6></label>
                                <div id="qtde_infra"></div>
                        </div>	

                        <div class="form-group col-md-1">
                                <label><h6>FP :  </h6></label>
                                <div id="fp_diario"> <?=$fator_prod?> </div>
                        </div>	

                        <div class="form-group col-md-1" >
                            <div id="txt_id_local" type="hidden"></div>
                        </div>
                    </div>    


                    <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Local: </label>
                                    <div > <select name="n_local" id="n_local" onChange="update()">
                                        <?php echo $localCombo; ?> </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="campo2">Nº da OS:</label>
                                    <input type="text" class="form-control" name="n_os" id="txt_n_os" required onkeypress="$(this).mask('00/0000')"/>
                                </div>
                                <!-- <div class="form-group col-md-2">
                                    <label>Local2: </label>
                                    <div id ="local_sel"> </select>
                                    </div>
                                </div> -->
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                                <label for="campo3">Data Mínima:</label>
                                        <input type="text" class="form-control" name="data_inicio" id="txt_inicio" />
                        </div>
                        <div class="form-group col-md-2">
                                <label for="campo4">Data Máxima:</label>
                                        <input type="text" class="form-control" name="data_fim" id="txt_fim" />
                                </div>
                            <div class="form-group col-md-2">
                                <label for="campo4">Selecione os Dias-Off:</label>
                                        <input type="text" class="form-control" name="txt_dias_off" id="txt_dias_off"  />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="stdiasoff">Total de dias Off:</label>    
                                <div id="tdiasoff"></div>
                            </div>
                    </div>      

                    <div class="row">
                        <div class="form-group col-md-2">   
                                    <label>Lista de Dias-Off:</label>  
                                    <div class="form-group col-md-12">  
                                    <div id="array_dias_off"></div>
                                    <ul class="list-group" id="lista"></ul>
                                    </div> 
                        </div>    
                        <div class="form-group col-md-6">
                                    <div class="form-group col-md-6">
                                        <label>Total de Urnas: </label>
                                        <input type="text" name="t_urnas" class="form-control" id="txt_t_urnas" required class="textboxclass" style="width: 150px" onkeypress="$(this).mask('00000')"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <div class="form-group col-md-6">
                                        <label>Total de Baterias: </label>
                                        <input type="text" name="t_baterias" class="form-control" id="txt_t_baterias" required class="textboxclass" style="width: 150px" onkeypress="$(this).mask('00000')" />
                                    </div>
                        </div>
                    </div>    
                    <p>

                    </p>
<!-- ----------------------------------------function -->

		<div class="card">
			<h5 class="card-header">Grupos de Atividades desta OS:</h5>
                	<div class="card-body">
                        <div class="form-group">
                            <p>
                            <label> Selecione os GA desta OS: </label>
                            </p>
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
										6.5.4-Exercitar os componentes internos e realizar testes funcionais utilizando o STE
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
									<input class="form-check-input" type="checkbox" value="" id="ga661" checked>
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
           			 </div><!-- -----	---------------------------------------- -->       
     	</div>
				<div class="card-footer text-muted">		
                            Depois de preencher as informações acima clique em "Calcular" e depois em "Gravar OS"
                </div>
					<div class="d-grid gap-2 d-md-block">
						
                        <button id="btn_calcularOS" class="btn btn-primary"  onclick="calcularOS()"><i class="fa fa-fw fa-calculator"></i>Calcular</button>  
                      
						
						<a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger">
						<i class="fa fa-fw fa-sync"></i>Limpar</a>
						
                    </div>
					<form class="row g-3">
                            <div class="form-group col-md-2">
                                <label>Dias do período:  </label>
                                <div id="qtde_dias_periodo"></div> 
                            </div>
                            <div class="form-group col-md-2">
                                <label>Dias disponíveis:  </label>
                                <div id="qtde_dias_disp"></div>
                            </div>
                            <div class="form-group col-md-2">
                                <label>QGA: </label>
                                <div id="qtde_ga"></div>
                            </div>
                            <div class="form-group col-md-2">   
                                <label>UST:  </label>
                                <div id="qtde_ust"></div>
                            </div>    
					</form>
                   <div class="row">  
                        <div class="form-group col-md-8">
                                <button id="btn_gravarOS" class="btn btn-primary" onclick="gravarOS()" >Gravar OS</button>  
                        </div>
                   </div> 
	            <!-- </div> -->
            </div>    
        </div>        
        <div class="container my-4">	
        </div>
                    <div class="card-footer text-muted">
				        SIMUEL 
		            </div>
</body>
</html>
<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Editar GA
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       TESTE
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>