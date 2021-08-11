<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Status</title>
	<?php include_once('php/formatacao.php');?>
	<?php
        //session_start();
        include ("php/conexao.php");
		include ("php/consulta_ciclo_os.php");
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
	if(isset($_REQUEST['id_local']) and $_REQUEST['id_local']!=""){
		$condition	.=	' AND id_local LIKE "%'.$_REQUEST['id_local'].'%" ';
	}
	
	// CALCULANDO O VALOR ATUAL DE URNAS PRODUZIDAS (STE) - SITUACAO ATUAL NO BANCO STATUS DE CADA LOCAL
	$userData	=	$db->getAllRecords('status','*',$condition,'ORDER BY id_local ');
	if(count($userData)>0){
		$s	=	'';
		foreach($userData as $val){
			$s++;
			$stotue2009[] = $val['totue2009']; 
			$stotue2010[] = $val['totue2010']; 
			$stotue2011[] = $val['totue2011']; 
			$stotue2013[] = $val['totue2013']; 
			$stotue2015[] = $val['totue2015']; 
			$stotue2020[] = $val['totue2020']; 
  			$stotue2022[] = $val['totue2022']; 
			$stotue2022[] = $val['totue2022']; 
			$stotue2022[] = $val['totue2022'];
			$idlocals[] = $val['id_local'];
		}
			
	 }		
			//CALCULANDO VALORES USANDO SELECT SUM
			//1 - TOTAIS DE URNAS PRODUZIDAS POR MODELO - TODOS OS LOCAIS
			$sql = "SELECT SUM(totue2009),SUM(totue2010),SUM(totue2011),SUM(totue2013),SUM(totue2015),SUM(totue2020), SUM(totue2022) FROM status ORDER BY id_local";
			$result2 = mysqli_query($conexao,$sql);
			$row = mysqli_fetch_row($result2);
			$ue2009_prod = $row[0];
			$ue2010_prod = $row[1];
			$ue2011_prod = $row[2];
			$ue2013_prod = $row[3];
			$ue2015_prod = $row[4];
			$ue2020_prod = $row[5];
			$ue2022_prod = $row[6];
		
	 		//TOTAIS DE URNAS PRODUZIDAS POR LOCAL	
			for ($loc = 1; $loc <=5; ++$loc) {	
				$sql = "SELECT SUM(totue2009),SUM(totue2010),SUM(totue2011),SUM(totue2013),SUM(totue2015),SUM(totue2020), SUM(totue2022), id_local FROM status WHERE id_local = $loc";
				$result2 = mysqli_query($conexao,$sql);
				$row = mysqli_fetch_array($result2);
				$produelocal[$loc] = $row[0] + $row[1] + $row[2] + $row[3] + $row[4] + $row[5];
			
				}
				for ($n = 1;  $n <=5; ++$n) {	
					$prodloc[$n]= $produelocal[$n];
				}
			//2 - TOTAIS DE URNAS EXISTENTES POR MODELO  - TODOS OS LOCAIS

			$sql = "SELECT SUM(qtde_ue2009),SUM(qtde_ue2010),SUM(qtde_ue2011),SUM(qtde_ue2013),SUM(qtde_ue2015),SUM(qtde_ue2020), SUM(qtde_ue2022) FROM local ORDER BY id_local";
			$result2 = mysqli_query($conexao,$sql);
			$row = mysqli_fetch_row($result2);
			$ue2009_total = $row[0];
			$ue2010_total = $row[1];
			$ue2011_total = $row[2];
			$ue2013_total = $row[3];
			$ue2015_total = $row[4];
			$ue2020_total = $row[5];
			$ue2022_total = $row[6];
			if ($val['id_local']="") {
				$idlocal[] = 0;

			} else {
				
				$idlocal[] = $val['id_local'];

			}
			
			
			//TOTAIS DE URNAS EXISTENTES POR LOCAL	
			for ($loc = 1;  $loc <=5; ++$loc) {	
				$sql = "SELECT SUM(qtde_ue2009),SUM(qtde_ue2010),SUM(qtde_ue2011),SUM(qtde_ue2013),SUM(qtde_ue2015),SUM(qtde_ue2020), SUM(qtde_ue2022), id_local FROM local WHERE id_local = $loc";
				$result2 = mysqli_query($conexao,$sql);
				$row = mysqli_fetch_array($result2);
				$totuelocal[$loc] = $row[0] + $row[1] + $row[2] + $row[3] + $row[4] + $row[5];
				//echo "Total de Urnas do NVI ".$loc." é = ".$totuelocal[$loc];
			
				// $totloc[$n]= $totuelocal[$loc];
			}

			for ($n = 1;  $n <=5; ++$n) {	
				$totloc[$n]= $totuelocal[$n];
				
			}

			//3 - O QUE RESTA - DIFERENÇA ENTRE O PRODUZIDO E O EXISTENTE - TODOS OS LOCAIS

			$ue2009_rest = $ue2009_total - $ue2009_prod;
			$ue2010_rest = $ue2010_total - $ue2010_prod;
			$ue2011_rest = $ue2011_total - $ue2011_prod;
			$ue2013_rest = $ue2013_total - $ue2013_prod;
			$ue2015_rest = $ue2015_total - $ue2015_prod;
			$ue2020_rest = $ue2020_total - $ue2020_prod;
			$ue2022_rest = $ue2022_total - $ue2022_prod;

			for ($loc = 1; $loc <=5; ++$loc) {	
				$restuelocal[$loc] = $totuelocal[$loc]-$produelocal[$loc];
				$restloc[$loc]= $restuelocal[$loc];
				
				
			}

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
			<!-- TABELA STATUS STE POR LOCAL     -->
					<h5 class="card-title"><i class="fa fa-th-list"></i></i> Total de Urnas com Manutenção Preventiva (STE) realizada por Local </h5>
					<table class="table table-striped table-bordered table-sm" table id="tab_status_ste">
						<thead>
							<tr class="bg-secondary text-white">
								<td style="text-align: center;" >Localidade</td>		
								<td style="text-align: center;" >Última atualização</td>
								<td style="text-align: center;" >UE2009</td>
								<td style="text-align: center;" >UE2010</td>
								<td style="text-align: center;" >UE2011</td>
								<td style="text-align: center;" >UE2013</td>
								<td style="text-align: center;" >UE2015</td>
								<td style="text-align: center;" >UE2020</td>
								<td style="text-align: center;" >UE2022</td>
								<td style="text-align: center;" >Total Urnas</td>
								<td style="text-align: center;" >Total da OS </td>
								<td style="text-align: center;" >% realizado </td>
								<!-- <td style="text-align: center;" >Ação</td> -->
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
								// $sql = "SELECT MAX(id_os), n_os FROM os WHERE id_local = '$id_local' ";
								// $result2 = mysqli_query($conexao,$sql);
								// $row = mysqli_fetch_row($result2);
								// $max_id_os = $row[0];
								//echo $max_id_os;
								//var_dump($local) ;
								$data =  substr($val['data_atualizacao'],0, 10);   
								$data2 = implode("/",array_reverse(explode("-",$data)));;
								
								// total de urnas do status
								$stot_urna = $stotue2009 + $stotue2010 + $stotue2011 + $stotue2013 +$stotue2015 + $stotue2020 + $stotue2022;
								
								// total da urnas da OS max
								$sql = "SELECT MAX(id_os), n_os, t_urnas FROM os WHERE id_local = $id_loc ";
								$result2 = mysqli_query($conexao,$sql);
								$row = mysqli_fetch_row($result2);
								$t_urna_os = $row[2];
								
								//calcular o percentual
								if ($t_urna_os == 0 or NULL) {

									$perc_totf = 0;
								}else {
									$perc_tot =  ($stot_urna * 100) / $t_urna_os;
									$perc_totf = number_format($perc_tot, 2);
								}
								
								?>
								<td style="text-align: center;" ><strong><?php echo $local ?></strong></td>
								<td style="text-align: center;" ><?php echo $data2 ?></td> 
								<td style="text-align: center;" ><?php echo $val['totue2009'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2010'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2011'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2013'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2015'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2020'];?></td>
								<td style="text-align: center;" ><?php echo $val['totue2022'];?></td>
								<td style="text-align: center;" data-nome="tot_urna" ><strong><?php echo $stot_urna;?></strong></td>
								<td style="text-align: center;" data-nome="tot_urna_os" ><strong><?php echo $t_urna_os;?></strong></td>
								<td style="text-align: center;" ><strong><?php echo $perc_totf."%";?></strong></td>
								<!-- <td style="text-align: center;" ><?php echo "" ;?></strong></td> -->
								<!-- <td align="center" > -->
									<!-- <a href="php/status_edit.php?editId=<?php echo $val['id_local'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i>Limpar </a>   -->
									<!-- <a href="php/status_delete.php?delId=<?php echo $val['id_local'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i></a> -->
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
				<!-- FIM TABELA STATUS STE POR LOCAL     -->

				<!-- INSERIR GRAFICOS AQUI   % total de urnas produzidas do total   -->

				<label>Resumo por Local</label>				
				<div class="row">
						<!-- <div class="col-md"> -->
							<div  id ="chart_local1" name="chart_local1"  style="width: 250px; height: 250px;"></div>   
					    <!-- </div> -->
						<!-- <div class="col-md"> -->
							<div  id ="chart_local2" name="chart_local2"  style="width: 250px; height: 250px;"></div>   
					    <!-- </div>	 -->
						<!-- <div class="col-md"> -->
							<div  id ="chart_local3" name="chart_local3"  style="width: 250px; height: 250px;"></div>   
					    <!-- </div>	 -->
						<!-- <div class="col-md"> -->
							<div  id ="chart_local4" name="chart_local4"  style="width: 250px; height: 250px;"></div>   
					    <!-- </div>	 -->
						<!-- <div class="col-md"> -->
							<div  id ="chart_local5" name="chart_local5"  style="width: 250px; height: 250px;"></div>   
					    <!-- </div>	 -->
				</div>							

				<label>Resumo por modelo de urna</label>			
				<div class="row">
						<div class="col-md-3">
							<div  id ="chart_ue2009" name="chart_ue2009"  style="width: 300px; height: 300px;"></div>   
					    </div>
						<div class="col-md-3">
							<div  id ="chart_ue2010" name="chart_ue2010"  style="width: 300px; height: 300px;"></div>   
					    </div>	
						<!-- <div class="col-sm-3">
							<div  id ="chart_ue2011" name="chart_ue2011"  style="width: 300px; height: 300px;"></div>   
					    </div>	  -->
						<div class="col-md-3">
							<div  id ="chart_ue2013" name="chart_ue2013"  style="width: 300px; height: 300px;"></div>   
					    </div>	
						<div class="col-md-3">
							<div  id ="chart_ue2015" name="chart_ue2015"  style="width: 300px; height: 300px;"></div>   
					    </div>	
				</div>			
				<!-- TABELA STATUS MANUT CORRETIVA POR LOCAL     -->		

					<h5 class="card-title"><i class="fa fa-th-list"></i></i> Total de Urnas com Manutenção Corretiva realizada por Local </h5>
					<table class="table table-striped table-bordered table-sm">
						<thead>
							<tr class="bg-secondary text-white">
								<td style="text-align: center;" >Localidade</td>		
								<td style="text-align: center;" >UEs SEM chamado</td>
								<td style="text-align: center;" >UEs COM chamado</td>
								<td style="text-align: center;" >BAT Reserva</td>
								<td style="text-align: center;" >BAT Substituídas </td>
								<td style="text-align: center;" >BAT Carregadas (BA) </td>
								<td style="text-align: center;" >BAT com vazamento* </td>
								<td style="text-align: center;" >BAT oxidadas* </td>
							
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
								$data =  substr($val['data_atualizacao'],0, 10);   
								$data2 = implode("/",array_reverse(explode("-",$data)));;
								$stot_urna = $stotue2009 + $stotue2010 + $stotue2011 + $stotue2013 +$stotue2015 + $stotue2020 + $stotue2022;
								?>
								<td style="text-align: center;" ><?php echo $local ?></td>
								<td style="text-align: center;" ><?php echo $val['tnue_sem_chamado'];?></td>
								<td style="text-align: center;" ><?php echo $val['tnue_com_chamado'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_reserva'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_subst'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_barriga_aluguel'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_vazando'];?></td>
								<td style="text-align: center;" ><?php echo $val['tbat_oxidada'];?></td>
								<!-- <td align="center" > -->
									<!-- <a href="php/status_edit.php?editId=<?php echo $val['id_local'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i>Limpar </a>   -->
									<!-- <a href="php/status_delete.php?delId=<?php echo $val['id_local'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i></a> -->
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

					</div> 
					</div> 

					<div class="card-footer text-muted">
						SIMUEL 
					</div>
		</div> 
					
	</div>

				<script type="text/javascript" src="https://www.google.com/jsapi"></script>
				<script type="text/javascript">
				//carregando modulo visualization
				google.load("visualization", "1", {packages:["corechart"]});

				//função de monta e desenha o gráfico
				function drawChart(){
					//variavel com armazenamos os dados, um array de array's
					//no qual a primeira posição são os nomes das colunas
					var data2009 = google.visualization.arrayToDataTable([
						['Modelo UE2009', 'Total'],
						['Concluídas', <?php echo $ue2009_prod ?>],
						['Faltam',<?php echo $ue2009_rest ?>],
						]);
					var data2010 = google.visualization.arrayToDataTable([
						['Modelo UE2010', 'Total'],
						['Concluídas', <?php echo $ue2010_prod ?>],
						['Faltam',<?php echo $ue2010_rest ?>],
						]);
					// var data2011 = google.visualization.arrayToDataTable([
					// 	['Modelo UE2011', 'Total'],
					// 	['Concluídas', <?php echo $ue2011_prod ?>],
					// 	['Faltam',<?php echo $ue2011_rest ?>],
					// 	]);	
					var data2013 = google.visualization.arrayToDataTable([
						['Modelo UE2013', 'Total'],
						['Concluídas', <?php echo $ue2013_prod ?>],
						['Faltam',<?php echo $ue2013_rest ?>],
						]);
					var data2015 = google.visualization.arrayToDataTable([
						['Modelo UE2015', 'Total'],
						['Concluídas', <?php echo $ue2015_prod ?>],
						['Faltam',<?php echo $ue2015_rest ?>],
						]);	
					var data2020 = google.visualization.arrayToDataTable([
						['Modelo UE2020', 'Total'],
						['Concluídas', <?php echo $ue2020_prod ?>],
						['Faltam',<?php echo $ue2020_rest ?>],
						]);
					var data2022 = google.visualization.arrayToDataTable([
						['Modelo UE2022', 'Total'],
						['Concluídas', <?php echo $ue2022_prod ?>],
						['Faltam',<?php echo $ue2022_rest ?>],
						]);				
			
					//opções para exibição do gráfico
					var options2009 = {
						title: 'UE2009',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
						colors: ['#008000', '#8B0000']
							
					};
					var options2010 = {
						title: 'UE2010',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
						colors: ['#008000', '#8B0000']	
					};
					// var options2011 = {
					// 	title: 'UE2011',//titulo do gráfico
					// 	is3D: true // false para 2d e true para 3d o padrão é false
							
					// };
					var options2013 = {
						title: 'UE2013',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
						colors: ['#008000', '#8B0000']	
					};

					var options2015 = {
						title: 'UE2015',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
						colors: ['#008000', '#8B0000']	
					};
					var options2020 = {
						title: 'UE2020',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
						colors: ['#008000', '#8B0000']	
					};
					var options2022 = {
						title: 'UE2022',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
						colors: ['#008000', '#8B0000']	
					};
				//cria novo objeto PieChart que recebe
				//como parâmetro uma div onde o gráfico será desenhado
					var chart2009 = new google.visualization.PieChart(document.getElementById('chart_ue2009'));
					var chart2010 = new google.visualization.PieChart(document.getElementById('chart_ue2010'));
					// var chart2011 = new google.visualization.PieChart(document.getElementById('chart_ue2011'));
					var chart2013 = new google.visualization.PieChart(document.getElementById('chart_ue2013'));
					var chart2015 = new google.visualization.PieChart(document.getElementById('chart_ue2015'));
					
				//desenha passando os dados e as opções
					chart2009.draw(data2009, options2009);
					chart2010.draw(data2010, options2010);
					// chart2011.draw(data2011, options2011);
					chart2013.draw(data2013, options2013);
					chart2015.draw(data2015, options2015);
				}
				google.setOnLoadCallback(drawChart);

				function drawChart2(){
					//variavel com armazenamos os dados, um array de array's
					//no qual a primeira posição são os nomes das colunas
					var local1 = google.visualization.arrayToDataTable([
						['NVI JPA', 'Total'],
						['Concluídas', <?php echo $prodloc[1] ?>],
						['Faltam',<?php echo $restuelocal[1] ?>],
						]);
					var local2 = google.visualization.arrayToDataTable([
						['NVI CGE', 'Total'],
						['Concluídas', <?php echo $prodloc[2] ?>],
						['Faltam',<?php echo $restuelocal[2] ?>],
						]);
					var local3 = google.visualization.arrayToDataTable([
						['NVI PAT', 'Total'],
						['Concluídas', <?php echo $prodloc[3] ?>],
						['Faltam',<?php echo $restuelocal[3] ?>],
						]);
					var local4 = google.visualization.arrayToDataTable([
						['NVI PBL', 'Total'],
						['Concluídas', <?php echo $prodloc[4] ?>],
						['Faltam',<?php echo $restuelocal[4] ?>],
						]);	
					var local5 = google.visualization.arrayToDataTable([
						['NVI CJZ', 'Total'],
						['Concluídas', <?php echo $prodloc[5] ?>],
						['Faltam',<?php echo $restuelocal[5] ?>],
						]);
					
					//opções para exibição do gráfico
					var opdatalocal1 = {
						title: 'NVI JPA',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
						colors: ['#008000', '#8B0000']	
					};
					var opdatalocal2 = {
						title: 'NVI CGE',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
						colors: ['#008000', '#8B0000']	
					};
					
					var opdatalocal3 = {
						title: 'NVI PAT',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
						colors: ['#008000', '#8B0000']	
					};
					var opdatalocal4 = {
						title: 'NVI PBL',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
						colors: ['#008000', '#8B0000']	
					};

					var opdatalocal5 = {
						title: 'NVI CJZ',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
						colors: ['#008000', '#8B0000']	
					};
				
					
				//cria novo objeto PieChart que recebe
				//como parâmetro uma div onde o gráfico será desenhado
					var datalocal1 = new google.visualization.PieChart(document.getElementById('chart_local1'));
					var datalocal2 = new google.visualization.PieChart(document.getElementById('chart_local2'));
					var datalocal3 = new google.visualization.PieChart(document.getElementById('chart_local3'));
					var datalocal4 = new google.visualization.PieChart(document.getElementById('chart_local4'));
					var datalocal5 = new google.visualization.PieChart(document.getElementById('chart_local5'));
					//desenha passando os dados e as opções
					datalocal1.draw(local1, opdatalocal1);
					datalocal2.draw(local2, opdatalocal2);
					datalocal3.draw(local3, opdatalocal3);
					datalocal4.draw(local4, opdatalocal4);
					datalocal5.draw(local5, opdatalocal5);
				}
				//metodo chamado após o carregamento
				google.setOnLoadCallback(drawChart2);
				</script>

	
</body>
</html>