<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicial</title>


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
</head>
<body>
    <?php
        session_start();
        include ("php/conexao.php");
        // include ("php/bootstrapalert.php");
        include_once('php/config.php');
		include ("php/funcoes.php");
        $dadosConexao = mysqli_get_host_info($conexao);
            if (!isset($_SESSION["usuario"])) {
                header('Location: index.php');
                exit();
            }
            include($_SESSION['menu']); 
            $ids_local = $_SESSION['id_local'];
		    $condition =	"AND id_local =".$ids_local;
            $userData	=	$db->getAllRecords('local','*',$condition,'ORDER BY id_local ');
    ?>
    <div class="container">
		<div class="row">
			<div class="form-group col-md-4" >
				<label><h6>Ciclo atual: 
				<div id="n_ciclo"><?= max_ciclo() ; ?></div></h6></label>
			</div>
			<div class="form-group col-md-4" >
				<label><h6>Nº da OS:  
				<div id ="n_os"> <?= max_os_local($ids_local) ; ?></div></h6></label>
			</div>

		
		

		</div>    	
       <br>
		<div class="card"> 
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Parque de equipamentos </h5>
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
                        <td style="text-align: center;" >Total UE</td>
						<td style="text-align: center;" >Baterias Reserva</td>
						<td style="text-align: center;" >Atualização</td>
						<!-- <td style="text-align: center;" class="text-center">Ação</td> -->
					</tr>
				</thead>
				<tbody>
					<?php 
					if(count($userData)>0){
						$s	=	'';
						foreach($userData as $val){
							$s++;
                            $totue2009 = $val['qtde_ue2009']; 
                            $totue2010 = $val['qtde_ue2010']; 
                            $totue2011 = $val['qtde_ue2011'];
                            $totue2013 = $val['qtde_ue2013'];
                            $totue2015 = $val['qtde_ue2015'];
                            $totue2020 = $val['qtde_ue2020'];
                            $totue2022 = $val['qtde_ue2022'];
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
                        $tot_ue = $totue2009 + $totue2010 + $totue2011 + $totue2013 + $totue2015 + $totue2020 + $totue2022;
						$sql = "SELECT qtde_baterias FROM local WHERE id_local = '$id_loc' ";
						$result = mysqli_query($conexao,$sql);
						$row = mysqli_fetch_row($result);
						$local = $row[0];		
						?>
						<td style="text-align: center;" ><?php echo $local;?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2009'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2010'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2011'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2013'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2015'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2020'];?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_ue2022'];?></td>
                        <td style="text-align: center;" ><?php echo $tot_ue;?></td>
						<td style="text-align: center;" ><?php echo $val['qtde_baterias'];?></td>
						<td style="text-align: center;" ><?php echo $data2;?></td>
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
			


			<!--------------- FORM TABELA 2  TABELA DE STATUS - RESUMO PARTE 1 - URNAS  / Consulta tabela STATUS-------------------->
	<?php

$ids_local = $_SESSION['id_local'];
$condition =	"AND id_local =".$ids_local;
$userData	=	$db->getAllRecords('status','*',$condition,'ORDER BY id_local');
?>
<br>
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Resumo Total: Manutenção Preventiva (dados cumulativos) </h5>
		 <!-- <div class="row">
			<div class="form-group col-md-9">
			<br><label>Data do último envio: </label> <? $data2; ?> 
			</div>
		</div> -->
				


		<table class="table table-striped table-bordered -sm table-sm">
		<caption>Atenção: dados cumulativos</caption>
			<thead>
				<tr class="bg-secondary text-white">
					<td style="text-align: center;" >UE2009</td>
					<td style="text-align: center;" >UE2010</td>
					<td style="text-align: center;" >UE2011</td>
					<td style="text-align: center;" >UE2013</td>
					<td style="text-align: center;" >UE2015</td>
					<td style="text-align: center;" >UE2020</td>
					<td style="text-align: center;" >UE2022</td>
					<td style="text-align: center;" >Total de UE</td>
					<td style="text-align: center;" >Total da OS</td>
					<td style="text-align: center;" >% Concluído da OS</td>
				<!-- <td style="text-align: center;" class="text-center">Ação</td> -->
				</tr>
			</thead>
			<tbody>
				<?php 
				if(count($userData)>0){
					$s	=	'';
					foreach($userData as $val){
						$s++;
						$stue2009 = $val['totue2009']; 
						$stue2010 = $val['totue2010']; 
						$stue2011 = $val['totue2011'];
						$stue2013 = $val['totue2013'];
						$stue2015 = $val['totue2015'];
						$stue2020 = $val['totue2020'];
						$stue2022 = $val['totue2022'];
				?>
				<tr>
					<?php
						$data =  substr($val['data_atualizacao'],0, 10);    
						$data2 = implode("/",array_reverse(explode("-",$data)));;
						$tot_ue = $stue2009 + $stue2010 + $stue2011 + $stue2013 + $stue2015 + $stue2020 + $stue2022;

						// total da urnas da OS max
						$sql = "SELECT MAX(id_os), n_os, t_urnas FROM os WHERE id_local = $ids_local";
						$result2 = mysqli_query($conexao,$sql);
						$row = mysqli_fetch_row($result2);
						$t_urna_os = $row[2];
						
						//calcular o percentual
						$perc_tot =  ($tot_ue * 100) / $t_urna_os;
						$perc_tot_st = number_format($perc_tot, 1);

						// calcular a diff para o grafico

						$tot_falta = $t_urna_os - $tot_ue;
					?>
					<td style="text-align: center;" ><strong><?php echo $val['totue2009'];?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $val['totue2010'];?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $val['totue2011'];?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $val['totue2013'];?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $val['totue2015'];?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $val['totue2020'];?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $val['totue2022'];?></strong></td>
					<td class="table-success" style="text-align: center;" ><strong><?php echo $tot_ue ?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $t_urna_os ?></strong></td>
					<td class="table-success" style="text-align: center;" ><strong><?php echo $perc_tot_st."%"?></strong></td>
											<!-- <td align="center"> -->
						<!-- <a href="php/producao_local_edit.php?editId=<?php echo $val['id_producao'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> |  -->
						<!-- <a href="php/producao_local_delete.php?delId=<?php echo $val['id_producao'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a> -->
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
	<!--------- FORM TABELA 2  TABELA DE STATUS - RESUMO PARTE 2 - MANUTENCAO PREVENTIVA  / Consulta tabela STATUS----------------->
		<h5 class="card-title"><i class="fa fa-th-list"></i></i> Resumo Total: Manutenção Corretiva (dados cumulativos) </h5>
		 <!-- <div class="row">
			<div class="form-group col-md-9">
			<br><label>Data do último envio: </label> <? $data2; ?> 
			</div>
		</div> -->
		<table class="table table-striped table-bordered -sm table-sm">
		<caption>Atenção: dados cumulativos</caption>
			<thead>
				<tr class="bg-secondary text-white">
					<td style="text-align: center;" >UEs SEM chamado</td>
					<td style="text-align: center;" >UEs COM chamado</td>
					<td style="text-align: center;" >BAT Reserva</td>
					<td style="text-align: center;" >BAT Substituídas </td>
					<td style="text-align: center;" >BAT "barriga-aluguel" </td>
					<td style="text-align: center;" >BAT com vazamento </td>
					<td style="text-align: center;" >BAT oxidadas</td>
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
					<td style="text-align: center;" ><strong><?php echo $val['tnue_sem_chamado'];?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $val['tnue_com_chamado'];?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $val['tbat_reserva'];?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $val['tbat_subst'];?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $val['tbat_barriga_aluguel'];?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $val['tbat_vazando'];?></strong></td>
					<td style="text-align: center;" ><strong><?php echo $val['tbat_oxidada'];?></strong></td>
					<!-- <td align="center"> -->
						<!-- <a href="php/producao_local_edit.php?editId=<?php echo $val['id_producao'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> |  -->
						<!-- <a href="php/producao_local_delete.php?delId=<?php echo $val['id_producao'];?>" class="text-danger" onClick="return confirm('Você tem certeza que quer apagar esse registro?');"><i class="fa fa-fw fa-trash"></i>Apagar</a> -->
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

						
            <footer>
            </footer>
            </div> 
			<div class="row" col-md-12>
							<div  id ="chart_div" name="chart_div"  style="width: 600px; height: 350px;"></div>  
							<div  id ="chart_div2" name="chart_div2" style="width: 600px; height: 350px;"> </div>
					    </div>
           
            <div class="card-footer text-muted">
						SIMUEL 
			</div>
	
	</div>  
	<script type="text/javascript"
    src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	
	//------------GRAFICO 1 -----------------------!>
	
	//carregando modulo visualization
	google.load("visualization", "1", {packages:["corechart"]});
	//função de monta e desenha o gráfico
	function drawChart() {
	//variavel com armazenamos os dados, um array de array's
	//no qual a primeira posição são os nomes das colunas
	var data = google.visualization.arrayToDataTable([
	['Modelo', 'Total'],
	['UE2009', <?php echo $val['totue2009'];?>],
	['UE2010', <?php echo $val['totue2010'];?>],
	['UE2011', <?php echo $val['totue2011'];?>],
	['UE2013', <?php echo $val['totue2013'];?>],
	['UE2015', <?php echo $val['totue2015'];?>],
	]);

	var data2 = google.visualization.arrayToDataTable([
	['Modelo', 'Total'],
	['Concluido', <?php echo $tot_ue;?>],
	['A Concluir', <?php echo $tot_falta;?>],
	]);


	//opções para exibição do gráfico
	var options = {
	title: 'Percentual total por modelo de urna já produzido',//titulo do gráfico
	is3D: true // false para 2d e true para 3d o padrão é false
	};

	var options2 = {
	title: 'Percentual total produzido ',//titulo do gráfico
	is3D: true // false para 2d e true para 3d o padrão é false
	};
	//cria novo objeto PieChart que recebe
	//como parâmetro uma div onde o gráfico será desenhado
	var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	//desenha passando os dados e as opções
	chart.draw(data, options);
	
	var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
	//desenha passando os dados e as opções
	chart2.draw(data2, options2);
	
	}
	//metodo chamado após o carregamento
	google.setOnLoadCallback(drawChart);

	
	

	</script>
				

	
</body>
</html>