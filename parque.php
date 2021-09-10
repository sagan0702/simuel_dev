<?php include_once('php/config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Parque de Equipamentos</title>
	<?php 
	include_once('php/formatacao.php');
    include ("php/bootstrapalert.php");
	?>
	<?php
        session_start();
        include ("php/conexao.php");
       
        
        
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
	if(isset($_REQUEST['n_ciclo']) and $_REQUEST['n_ciclo']!=""){
		$condition	.=	' AND n_ciclo LIKE "%'.$_REQUEST['n_ciclo'].'%" ';
	}
	if(isset($_REQUEST['data_inicio']) and $_REQUEST['data_inicio']!=""){
		$condition	.=	' AND data_inicio LIKE "%'.$_REQUEST['data_inicio'].'%" ';
	}
	if(isset($_REQUEST['data_fim']) and $_REQUEST['data_fim']!=""){
		$condition	.=	' AND data_fim LIKE "%'.$_REQUEST['data_fim'].'%" ';
	}
	if(isset($_REQUEST['estado']) and $_REQUEST['estado']!=""){
		$condition	.=	' AND estado LIKE "%'.$_REQUEST['estado'].'%" ';
	}
		
	$userData	=	$db->getAllRecords('local','*',$condition,'ORDER BY id_local ');
	?>
   	<div class="container">
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
			<h3>Parque de Equipamentos por Localidade</h3>
				<!-- <i class="fa fa-fw fa-globe"></i> <strong>Pequisar </strong>  -->
				<!-- <a href="php/ciclo_add.php" class="float-left btn btn-dark btn-lg"> 
				<i class="fa fa-fw fa-plus-circle"></i>  Adicionar </a></div> - BOTÃO DE AÇÃO -->
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
		<div>   <!--- MOSTRA A TABELA DE REGISTROS  -->
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Equipamentos por local </h5>
			<table class="table table-striped table-bordered table-sm">
				<thead>
					<tr class="bg-secondary text-white">
						<td style="text-align: center;" >Localidade</td>		
						<td style="text-align: center;" >UE2009</td>
						<td style="text-align: center;" >UE2010</td>
						<td style="text-align: center;" >UE2011</td>
						<td style="text-align: center;" >UE2013</td>
						<td style="text-align: center;" >UE2015</td>
						<td style="text-align: center;" >UE2020</td>
						<td style="text-align: center;" >UE2022</td>
						
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

						
						<?php
						$id_loc = $val['id_local'];
						$sql = "SELECT n_local FROM local WHERE id_local = '$id_loc' ";
						$result = mysqli_query($conexao,$sql);
						$row = mysqli_fetch_row($result);
						$local = $row[0];
						//var_dump($local) ;
						$data =  substr($val['data_atualizacao'],0, 10);   
						$data2 = implode("/",array_reverse(explode("-",$data)));;
						?>
						<td style="text-align: center;" ><?php echo $local;?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2009'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2010'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2011'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2013'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2015'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2020'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2022'];?></td>
						
						
						<!-- <td align="center" >
							<a href="php/producao_edit.php?editId=<?php echo $val['id_producao'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i></a>  
							<a href="php/producao_delete.php?delId=<?php echo $val['id_producao'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i></a>
						</td> -->

					</tr>
					<?php 
						}
					}else{
					?>
					<tr><td colspan="6" align="center">Nenhum registro encontrado!</td></tr>
					<?php } ?>
				</tbody>
			</table>
						
					</form>
					
				</div>
				
						<div class="row d-flex justify-content-center"  >
							<div  id ="chart_local1" name="chart_local1"  style="width: 700px; height: 500px;"></div>   
					    </div>	



			</div>
			<div class="card-footer text-muted">
						SIMUEL 
			</div>

			<?php
			
			//SELECT NVI 1
						$sql = "SELECT * FROM local WHERE id_local = 1";
						$result = $conexao->query($sql);
						if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							$ue2009_nvi_jpa = $row["qtde_ue2009"]; 
							$ue2010_nvi_jpa = $row["qtde_ue2010"];
							$ue2011_nvi_jpa = $row["qtde_ue2011"];
							$ue2013_nvi_jpa = $row["qtde_ue2013"];
							$ue2015_nvi_jpa = $row["qtde_ue2015"];
							$ue2020_nvi_jpa = $row["qtde_ue2020"];
							$ue2020_nvi_jpa = $row["qtde_ue2022"];
						}
						} else {
						echo "0 results";
						}
						$conexao->close();


			//SELECT NVI 2



			//SELECT NVI 3




			//SELECT NVI 4


			
			
			//SELECT NVI 5




			?>



					

		</div>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
				<script type="text/javascript">
				//carregando modulo visualization
				google.load("visualization", "1", {packages:["corechart"]});
                // GRAFICO TOTAL DE URNAS DO TRE POR MODELO
				//função de monta e desenha o gráfico
				function drawChart(){
					//variavel com armazenamos os dados, um array de array's
					//no qual a primeira posição são os nomes das colunas
					var data2009 = google.visualization.arrayToDataTable([
						['Modelo', 'Total'],
						['UE2009',<?php echo $ue2009_nvi_jpa ?>],
						['UE2010',<?php echo $ue2009_nvi_jpa ?>],
						['UE2011',<?php echo $ue2009_nvi_jpa ?>],
						['UE2013',<?php echo $ue2009_nvi_jpa ?>],
						['UE2015',<?php echo $ue2009_nvi_jpa ?>],
						['UE2020',<?php echo $ue2009_nvi_jpa ?>],
						['UE2022',<?php echo $ue2009_nvi_jpa ?>],
						]);
					
			
					//opções para exibição do gráfico
					var options2009 = {
						title: 'UE2009',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
					
							
					}



				//cria novo objeto PieChart que recebe
				//como parâmetro uma div onde o gráfico será desenhado
					var chart2009 = new google.visualization.PieChart(document.getElementById('chart_ue2009'));
					
					
				//desenha passando os dados e as opções
					chart2009.draw(data2009, options2009);
					
				}
				google.setOnLoadCallback(drawChart);
 				
				
				// GRAFICO TOTAL DE URNAS DO TRE POR MODELO
				function drawChart2(){
					//variavel com armazenamos os dados, um array de array's
					//no qual a primeira posição são os nomes das colunas
					var local1 = google.visualization.arrayToDataTable([
						['NVI JPA', 'Total'],
						['UE2009',<?php echo $ue2009_nvi_jpa ?>],
						['UE2010',<?php echo $ue2010_nvi_jpa ?>],
						['UE2011',<?php echo $ue2011_nvi_jpa ?>],
						['UE2013',<?php echo $ue2013_nvi_jpa ?>],
						['UE2015',<?php echo $ue2015_nvi_jpa ?>],
						['UE2020',<?php echo $ue2020_nvi_jpa ?>],
						['UE2022',<?php echo $ue2022_nvi_jpa ?>],
						]);
					var local2 = google.visualization.arrayToDataTable([
						['NVI CGE', 'Total'],
						['UE2009',<?php echo $prodloc[1] ?>],
						['UE2010',<?php echo $restuelocal[1] ?>],
						['UE2011',<?php echo $restuelocal[1] ?>],
						['UE2013',<?php echo $restuelocal[1] ?>],
						['UE2015',<?php echo $restuelocal[1] ?>],
						['UE2020',<?php echo $restuelocal[1] ?>],
						['UE2022',<?php echo $restuelocal[1] ?>],
						]);
					var local3 = google.visualization.arrayToDataTable([
						['NVI PAT', 'Total'],
						['UE2009',<?php echo $prodloc[1] ?>],
						['UE2010',<?php echo $restuelocal[1] ?>],
						['UE2011',<?php echo $restuelocal[1] ?>],
						['UE2013',<?php echo $restuelocal[1] ?>],
						['UE2015',<?php echo $restuelocal[1] ?>],
						['UE2020',<?php echo $restuelocal[1] ?>],
						['UE2022',<?php echo $restuelocal[1] ?>],
						]);
					var local4 = google.visualization.arrayToDataTable([
						['NVI PBL', 'Total'],
						['UE2009',<?php echo $prodloc[1] ?>],
						['UE2010',<?php echo $restuelocal[1] ?>],
						['UE2011',<?php echo $restuelocal[1] ?>],
						['UE2013',<?php echo $restuelocal[1] ?>],
						['UE2015',<?php echo $restuelocal[1] ?>],
						['UE2020',<?php echo $restuelocal[1] ?>],
						['UE2022',<?php echo $restuelocal[1] ?>],
						]);	
					var local5 = google.visualization.arrayToDataTable([
						['NVI CJZ', 'Total'],
						['UE2009',<?php echo $prodloc[1] ?>],
						['UE2010',<?php echo $restuelocal[1] ?>],
						['UE2011',<?php echo $restuelocal[1] ?>],
						['UE2013',<?php echo $restuelocal[1] ?>],
						['UE2015',<?php echo $restuelocal[1] ?>],
						['UE2020',<?php echo $restuelocal[1] ?>],
						['UE2022',<?php echo $restuelocal[1] ?>],
						]);
					
					//opções para exibição do gráfico
					var opdatalocal1 = {
						title: 'NVI JPA',//titulo do gráfico
						is3D: true, // false para 2d e true para 3d o padrão é false
							
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

	
	</div>

	
</body>
</html>
