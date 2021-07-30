<?php include_once('config.php');?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Parque de Equipamentos - Consulta no Banco ASI Web - ORACLE</title>
</head>	
	<?php 
	include_once('formatacao.php');
    include ("bootstrapalert.php");
	session_start();
    include ("conexao.php");
	$conn = oci_connect('SIMUEL_OP', 'mtZVWPFZbcZQlPwOmlj5', 'srvoda1.tre-pb.gov.br/ADM');
	if (!$conn) {
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		
		$sql1 = $sql1 = "SELECT LOCALIZACAO , MATERIAL , MODELO, SUM(1) AS SOMA 
		FROM ASIWEB.VW_PB_PATRIMONIO  
		WHERE LOCALIZACAO LIKE '%NUCLEO DE VOTO INFORMATIZADO%' AND MATERIAL = 'URNA ELETRONICA PARA VOTACAO' 
		GROUP BY LOCALIZACAO , MATERIAL , MODELO
		ORDER BY LOCALIZACAO ";
		$stid = oci_parse($conn, $sql1);
		oci_execute($stid);
				
	?>
<body>
   <div class="container">
		<div class="card"> <!--- FORM DE PESQUISA -->
			<div class="card-header">
			<h3>Parque de Equipamentos por Localidade -  ASIWEB / ORACLE</h3>
			<div class="card-body"> <!--- MENSAGENS -->

		<div>   <!--- MOSTRA A TABELA DE REGISTROS  -->
			<h5 class="card-title"><i class="fa fa-th-list"></i></i> Equipamentos por local </h5>
						<table class="table table-striped table-bordered table-sm">
								<thead>
									<tr class="bg-secondary text-white">
										<td style="text-align: center;" >NVI</td>		
										<td style="text-align: center;" >Material</td>
										<td style="text-align: center;" >Modelo</td>
										<td style="text-align: center;" >Total de Urnas</td>
										
									</tr>
								</thead>
								<tbody>
									<?php 
									while (($row = oci_fetch_assoc($stid)) != false) {
									?>
									<tr>
										<td style="text-align: center;" ><?php echo $row['LOCALIZACAO'];?></td>
										<td style="text-align: center;" ><?php echo $row['MATERIAL'];?></td>
										<td style="text-align: center;" ><?php echo $row['MODELO'];?></td>
										<td style="text-align: center;" ><?php echo $row['SOMA'];?></td>
									</tr>
								<?php } ?>          
								</tbody>
						</table>
						<?php 				
							//echo $nrows = oci_fetch_all($stid, $results);
							oci_free_statement($stid);
							oci_close($conn);

						?>

						
				</div>
						
			</div>
					<div class="card-footer text-muted">
						SIMUEL 
					</div>
					
		

	</div>

</body>
</html>
