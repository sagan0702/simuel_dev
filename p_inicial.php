<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicial</title>
</head>
<body>
    <?php
        session_start();
        include ("php/conexao.php");
        // include ("php/bootstrapalert.php");
        include_once('php/config.php');
        $dadosConexao = mysqli_get_host_info($conexao);
            if (!isset($_SESSION["usuario"])) {
                header('Location: index.php');
                exit();
            }
            include($_SESSION['menu']); 
            $ids_local = $_SESSION['id_local'];
		    //echo $id_local;
		    $condition =	"AND id_local =".$ids_local;
            $userData	=	$db->getAllRecords('local','*',$condition,'ORDER BY id_local ');
    ?>
    <div class="container">
        <div class="row">
            <div class="form-group col-md-9">
            <br><label>O usuário logado é: </label> <?= $_SESSION['usuario'] ?> 
            </div>
            <div class="form-group col-md-4">
                <br><?php print_r($dadosConexao) ?> 
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
			
						
            <footer>
            </footer>
            </div> 
						
						<div class="row d-flex justify-content-center"  >
							<div  id ="chart_div" name="chart_div"  style="width: 700px; height: 500px;"></div>   
					    </div>	
           
            <div class="card-footer text-muted">
						SIMUEL 
			</div>
	
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
          ['Modelo', 'Total'],
		  ['UE2009', <?php echo $val['qtde_ue2009'];?>],
          ['UE2010', <?php echo $val['qtde_ue2010'];?>],
		  ['UE2011', <?php echo $val['qtde_ue2011'];?>],
		  ['UE2013', <?php echo $val['qtde_ue2013'];?>],
		  ['UE2015', <?php echo $val['qtde_ue2015'];?>],
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

	
</body>
</html>