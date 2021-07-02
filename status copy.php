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
			$idlocal[] = $val['id_local'];
		}
			$maxlocal = max($idlocal) - 1 ;
			// echo "MAX VALOR LOCAL É".$maxlocal;
			$totue2009pd = 0;
			$totue2010pd = 0;
			$totue2011pd = 0; 
			$totue2013pd = 0;
			$totue2015pd = 0;
			$totue2020pd = 0;
			$totue2022pd = 0;	
			for ($i = 0; $i <= 4; $i++) {
				// echo $i;
				//total de urnas produzidas por local
				$stot[$i] = $stotue2009[$i] + $stotue2010[$i] + $stotue2011[$i] + $stotue2013[$i] + $stotue2015[$i] + $stotue2020[$i] + $stotue2022[$i];
				// echo "Total de Urnas Produzidas do local ".$i." é ".$stot[$i];
				?><html><br></html><?php
				//total de urnas produzidas por modelo somando todos locais (1ª VARIAVEL)
				$totue2009pd = $totue2009pd + $stotue2009[$i] ;
				$totue2010pd = $totue2010pd + $stotue2010[$i] ;
				$totue2011pd = $totue2011pd + $stotue2011[$i] ;
				$totue2013pd = $totue2013pd + $stotue2013[$i] ;
				$totue2015pd = $totue2015pd + $stotue2015[$i] ;
				$totue2020pd = $totue2020pd + $stotue2020[$i] ;
				$totue2022pd = $totue2022pd + $stotue2022[$i] ;
			}
				// echo "Total de Urnas Produzidas por modelo UE2009 - ".$totue2009pd;
				// echo "Total de Urnas Produzidas por modelo UE2010 - ".$totue2010pd;
				// echo "Total de Urnas Produzidas por modelo UE2011 - ".$totue2011pd;
				// echo "Total de Urnas Produzidas por modelo UE2013 - ".$totue2013pd;
				// echo "Total de Urnas Produzidas por modelo UE2015 - ".$totue2015pd;
				// echo "Total de Urnas Produzidas por modelo UE2020 - ".$totue2020pd;
				// echo "Total de Urnas Produzidas por modelo UE2022 - ".$totue2022pd;
	 }		
	 //echo "TESTE Total de Urnas do local 0  é ".$stot[0];

	// CALCULANDO O TOTAL DE URNAS MAX DE CADA OS POR LOCAL - TOTAL DE URNAS DE CADA LOCAL DA OS
	// valor de total de urnas cadastrado na OS

	$userData2	=	$db->getAllRecords('os','*',$condition,'ORDER BY id_local');
	if(count($userData2)>0){
		$u	=	'';
		foreach($userData2 as $valor){
			$u++;
			$os_totue[] = $valor['t_urnas']; 
			$os_totbat[] = $valor['t_baterias']; 
			$idlocal[] = $valor['id_local'];
		
		}
			
			for ($i = 0; $i <=  4; $i++) {
				// echo $i;
				$tot_ue_os[$i] = $os_totue[$i];
				$tot_bat_os[$i] = $os_totbat[$i];
				// $totue2009pd = $totue2009pd + $stotue2009[$i] ;
				// $tot_ue_rest[$i] = $os_totue[$i] - $stot[$i] ;
				// $tot_bat_rest[$i] = $os_totbat[$i]- $os_totbat[$i];
			
				// echo "Total de Urnas que faltam do local ".$i." é ".$tot_ue_rest[$i];
			
				echo "Total de Urnas da OS do local ".$i." é ".$tot_ue_os[$i];
				echo "-";
				echo "Total de Urnas de Bat do local ".$i." é ".$tot_bat_os[$i];
			
				?><html><br></html><?php
			}
			
	 }		

	// CALCULANDO O TOTAL DE URNAS QUE RESTAM DE CADA LOCAL POR MODELO / CALCULAR O TOTAL DE URNAS POR MODELO DE CADA LOCAL
	
	// calculando o total de urnas por modelo de cada local
	$userData3	=	$db->getAllRecords('local','*',$condition,'ORDER BY id_local');
	
	
	
	if(count($userData3)>0){
		$u	=	'';
		foreach($userData3 as $valor){
			$u++;
			$qtde_ue2009[] = $valor['qtde_ue2009']; 
			$qtde_ue2010[] = $valor['qtde_ue2010']; 
			$qtde_ue2011[] = $valor['qtde_ue2011']; 
			$qtde_ue2013[] = $valor['qtde_ue2013']; 
			$qtde_ue2015[] = $valor['qtde_ue2015']; 
			$qtde_ue2020[] = $valor['qtde_ue2020']; 
			$qtde_ue2022[] = $valor['qtde_ue2022']; 
			$idlocal[] = $valor['id_local'];	
		}
			//calculando o valor total geral somando todos locais por modelo de urna (2ª VARIAVEL)

			$qtde_tue2009 = 0;
			$qtde_tue2010 = 0;
			$qtde_tue2011 = 0; 
			$qtde_tue2013 = 0;
			$qtde_tue2015 = 0;
			$qtde_tue2020 = 0;
			$qtde_tue2022 = 0;	


			for ($i = 0; $i <=  4; $i++) {
				// echo $i;
				// $qtde_ue2009_rest[$i] = $qtde_ue2009[$i] - $stotue2009[$i] ;
				// $qtde_ue2010_rest[$i] = $qtde_ue2010[$i] - $stotue2010[$i] ;
				// $qtde_ue2011_rest[$i] = $qtde_ue2011[$i] - $stotue2011[$i] ;
				// $qtde_ue2013_rest[$i] = $qtde_ue2013[$i] - $stotue2013[$i] ;
				// $qtde_ue2015_rest[$i] = $qtde_ue2015[$i] - $stotue2015[$i] ;
				// $qtde_ue2020_rest[$i] = $qtde_ue2020[$i] - $stotue2020[$i] ;
				// $qtde_ue2022_rest[$i] = $qtde_ue2022[$i] - $stotue2022[$i] ;
				

				$qtde_tue2009 = $qtde_tue2009 + $qtde_ue2009[$i];
				$qtde_tue2010 = $qtde_tue2010 + $qtde_ue2010[$i];
				$qtde_tue2011 = $qtde_tue2011 + $qtde_ue2011[$i];
				$qtde_tue2013 = $qtde_tue2013 + $qtde_ue2013[$i];
				$qtde_tue2015 = $qtde_tue2015 + $qtde_ue2015[$i];
				$qtde_tue2020 = $qtde_tue2020 + $qtde_ue2020[$i];
				$qtde_tue2022 = $qtde_tue2022 + $qtde_ue2022[$i];


				//calcuando o valor total restante por modelo de urna (3ª VARIAVEL - FINAL)
				// $totue2009pd = $totue2009pd + $stotue2009[$i] ;
				// $tot_ue_rest[$i] = $os_totue[$i] - $stot[$i] ;
				// $tot_bat_rest[$i] = $os_totbat[$i]- $os_totbat[$i];

				// $qtde_ue2009_rest[$i] = $qtde_ue2009[$i] - $stotue2009[$i] ;
				// $qtde_ue2010_rest[$i] = $qtde_ue2010[$i] - $stotue2010[$i] ;
				// $qtde_ue2011_rest[$i] = $qtde_ue2011[$i] - $stotue2011[$i] ;
				// $qtde_ue2013_rest[$i] = $qtde_ue2013[$i] - $stotue2013[$i] ;
				// $qtde_ue2015_rest[$i] = $qtde_ue2015[$i] - $stotue2015[$i] ;
				// $qtde_ue2020_rest[$i] = $qtde_ue2020[$i] - $stotue2020[$i] ;
				// $qtde_ue2022_rest[$i] = $qtde_ue2022[$i] - $stotue2022[$i] ;

				$qtde_ue2009_rest = $qtde_ue2009[$i] - $totue2009pd;
				$qtde_ue2010_rest = $qtde_ue2010[$i] - $totue2010pd;
				$qtde_ue2011_rest = $qtde_ue2011[$i] - $totue2011pd;
				$qtde_ue2013_rest = $qtde_ue2013[$i] - $totue2013pd;
				$qtde_ue2015_rest = $qtde_ue2015[$i] - $totue2015pd;
				$qtde_ue2020_rest = $qtde_ue2020[$i] - $totue2020pd;
				$qtde_ue2022_rest = $qtde_ue2022[$i] - $totue2022pd;
			
				


				
				
				//total de urnas produzidas por modelo (1ª VARIAVEL) 

				// echo "Total de Urnas que faltam do local ".$i." é ".$tot_ue_rest[$i];
			
				// echo "Total que resta de Urnas do local: ".$idlocal[$i]." UE2009:".$qtde_ue2009_rest[$i]. "UE2010:".$qtde_ue2010_rest[$i]. "UE2011:".$qtde_ue2011_rest[$i]. "UE2013:".$qtde_ue2013_rest[$i]. "UE2015:".$qtde_ue2015_rest[$i]. "UE2020:".$qtde_ue2020_rest[$i]. "UE2022:".$qtde_ue2022_rest[$i]
				
			
				?><html><br></html><?php
			}
				echo "Total que resta de Urnas UE2009: ".$qtde_ue2009_rest;
				?><html><br></html><?php
				echo "Total que resta de Urnas UE2010: ".$qtde_ue2010_rest;
				?><html><br></html><?php
				echo "Total que resta de Urnas UE2011: ".$qtde_ue2011_rest;
				?><html><br></html><?php
				echo "Total que resta de Urnas UE2013: ".$qtde_ue2013_rest;
				?><html><br></html><?php
				echo "Total que resta de Urnas UE2015: ".$qtde_ue2015_rest;
				?><html><br></html><?php
				echo "Total que resta de Urnas UE2020: ".$qtde_ue2020_rest;
				?><html><br></html><?php
				echo "Total que resta de Urnas UE2022: ".$qtde_ue2022_rest;
				?><html><br></html><?php
	 }	
	 




	 
	 
	 // CALCULANDO O TOTAL DE URNAS QUE RESTAM DE CADA LOCAL sem identificar modelo


	
			
			for ($i = 0; $i <=  4; $i++) {
				// echo $i;
				$tot_ue_rest[$i] = $os_totue[$i] - $stot[$i] ;
				// $tot_bat_rest[$i] = $os_totbat[$i]- $os_totbat[$i];
				echo "Total de Urnas Produzidas do local ".$i." é ".$stot[$i];
				echo "-";
				echo "Total de Urnas da OS do local ".$i." é ".$tot_ue_os[$i];
				echo "-";
				echo "Total de Urnas que faltam do local ".$i." é ".$os_totue[$i]." - ".$stot[$i]." = ".$tot_ue_rest[$i];
				// echo "Total de Urnas de Bat que faltam do local ".$i." é ".$tot_bat_rest[$i];
				?><html><br></html><?php
			}
			
			echo "Total de Urnas que faltam do local NVI PAT".$i." é ".$os_totue[2]." - ".$stot[2]." = ".$tot_ue_rest[2];
		
			





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
								<td style="text-align: center;" >Data de Envio</td>
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
						<div class="row d-flex justify-content-center"  >
							<div  id ="chart_div" name="chart_div"  style="width: 700px; height: 500px;"></div>   
					    </div>	

					<div class="card-footer text-muted">
						SIMUEL 
					</div>
		</div> 



		
					
	</div>

		<!-- <script type="text/javascript" src="https://www.google.com/jsapi"></script>
			<script type="text/javascript"> -->
			<script>
			// $('#tab_status_ste').each(function() {
			// 	var tot_urna = $(this).find(".tot_urna").html();    
			// 	alert($(this).html());
			// });


			//------------GRAFICO 1 % PROD UE2009-----------------------!>
			
			//carregando modulo visualization
			google.load("visualization", "1", {packages:["corechart"]});
			//função de monta e desenha o gráfico
			function drawChart() {
			//variavel com armazenamos os dados, um array de array's
			//no qual a primeira posição são os nomes das colunas
			var data = google.visualization.arrayToDataTable([
			['Modelo UE2009', 'Total'],
			['Concluídas',$totue2009pd[]],
			['Faltam',$qtde_ue2009_rest[1] ,
			// ['UE2010',21],
			// ['UE2011',11],
			// ['UE2013',12],
			// ['UE2015',34],
			]);

			

			//opções para exibição do gráfico
			var options = {
			title: 'Percentual total por modelo de urna já produzido',//titulo do gráfico
			is3D: true // false para 2d e true para 3d o padrão é false
			};

			
			//cria novo objeto PieChart que recebe
			//como parâmetro uma div onde o gráfico será desenhado
			var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
			//desenha passando os dados e as opções
			chart.draw(data, options);
			
			
			
			}
			//metodo chamado após o carregamento
			google.setOnLoadCallback(drawChart);

			
			

			</script>




		

	
</body>
</html>