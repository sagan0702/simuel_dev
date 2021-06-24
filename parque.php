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
            include($_SESSION['menu']); 
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
							<div  id ="chart_div" name="chart_div"  style="width: 700px; height: 500px;"></div>   
					    </div>	



			</div>
			<div class="card-footer text-muted">
						SIMUEL 
					</div>


						<!-- somar valores por modelo de urna e fazer grafico -->
						<?php 	
						$sql = "SELECT * FROM status";
						$result = mysqli_query($conexao,$sql);
						$row = mysqli_fetch_row($result);
						$a = $row[0];
						$b = $row[1];
						$c = $row[2];
						$d = $row[3];

						echo "a - ".$a;
						echo "b - ".$b;
						echo "c - ".$c;
						echo "d - ".$d;

						?>



		</div>
				<script type="text/javascript"
   				 src="https://www.google.com/jsapi"></script>
    				<script type="text/javascript">
					
						//carregando modulo visualization
					google.load("visualization", "1", {packages:["corechart"]});

					//função de monta e desenha o gráfico
					function drawChart() {
					//variavel com armazenamos os dados, um array de array's
					//no qual a primeira posição são os nomes das colunas
					var data = google.visualization.arrayToDataTable([
						// ['Modelo', 'Total'],
						// ['UE2009', <?php echo $val['qtde_ue2009'];?>],
						// ['UE2010', <?php echo $val['qtde_ue2010'];?>],
						// ['UE2011', <?php echo $val['qtde_ue2011'];?>],
						// ['UE2013', <?php echo $val['qtde_ue2013'];?>],
						// ['UE2015', <?php echo $val['qtde_ue2015'];?>],

						['Modelo', 'Total'],
						['UE2009', 10],
						['UE2010', 34],
						['UE2011', 45],
						['UE2013', 11],
						['UE2015', 4],

						]);
						//opções para exibição do gráfico
						var options = {
								title: 'Percentual do parque do urnas por modelo',//titulo do gráfico
								is3D: true // false para 2d e true para 3d o padrão é false
						};
						//cria novo objeto PeiChart que recebe
						//como parâmetro uma div onde o gráfico será desenhado
						var chart = new google.visualization
						.PieChart(document.getElementById('chart_div'));
						//desenha passando os dados e as opções
						chart.draw(data, options);
					}
					//metodo chamado após o carregamento
					google.setOnLoadCallback(drawChart);
					
					
					
					</script>			



	
	</div>

	
</body>
</html>
