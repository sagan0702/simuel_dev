<?php include_once('config.php');
if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($n_os==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un');
		exit;
	}elseif($data_minima==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=ue');
		exit;
	}elseif($data_maxima==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=up');
		exit;
	}else{
		//converter para data br -> data mysql
		$data_minima = implode("-",array_reverse(explode("/",$data_minima)));
		$data_maxima = implode("-",array_reverse(explode("/",$data_maxima)));
		$userCount	=	$db->getQueryCount('os','id_os');
		if($userCount[0]['total']<20){
			$data	=	array(
							'n_os'=>$n_os,
							'id_ciclo'=>$id_ciclo,
							'data_minima'=>$data_minima,
							'data_maxima'=>$data_maxima,
							'estado'=>$estado,
						);
			$insert	=	$db->insert('os',$data);
			if($insert){
				header('location:/simuel/os.php?msg=ras');
				exit;
			}else{
				header('location:/simuel/os.php?msg=rna');
				exit;
			}
		}else{
			header('location:'.$_SERVER['PHP_SELF'].'?msg=dsd');
			exit;
		}
	}
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
    <link rel="stylesheet" type="text/css" href="css/estilo.css">

<style> 
   #n_ciclo{
        background-color: whitesmoke;
        color: green;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        width: 150px;
    } 
    #data_inicio{
        background-color: whitesmoke;
        color: green;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        
    }

    #data_fim{
        background-color: whitesmoke;
        color:green;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
    }
   
 
    #div_fp_diario{
        background-color: whitesmoke;
        color: green;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        width: 100px;
    } 
    #qtde_infra{
        background-color: yellow;
        color: green;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        width: 100px;
    }

    #qtde_dias_periodo{
        background-color: yellow;
        color: red;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        padding: 5px, 0, 5px, 0;
    }
    #qtde_dias_disp{
        background-color: yellow;
        color: red;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        padding: 15px, 0, 15px, 0;
    }
    
    #qtde_ga{
        background-color: yellow;
        color: red;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        padding: 15px, 0, 15px, 0;
    }

    #qtde_ust{
        background-color: yellow;
        color: red;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        padding: 15px, 0, 15px, 0;
    }

    #txt_inicio
    {
        background-color: whitesmoke;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
    #txt_fim
    {
        background-color: whitesmoke;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }

    #txt_dias_off
    {
        background-color: whitesmoke;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }

    #txt_t_urnas
    {
        background-color: whitesmoke;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 100px;
        font-size: 20px;
    }

    #txt_t_baterias
    {
        background-color: whitesmoke;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 100px;
        font-size: 20px;
    }

    #txt_n_os
    {
        background-color: whitesmoke;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
    #n_local
    {
        background-color: whitesmoke;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }
    #txt_n_ciclo
    {
        background-color: yellow;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 150px;
        font-size: 20px;
    }

    #tdiasoff
    {
        background-color: whitesmoke;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 100px;
        font-size: 20px;
    }

    #btn_calcularOS
    {

    /* padding: 25px, 25px, 25px, 25px; */
    margin-top: 35px ;    
    margin-bottom: 35px   ;
    }

    #btn_gravarOS
    {

    /* padding: 25px, 25px, 25px, 25px; */
    margin-bottom: 35px   ;
    margin-top: 55px ;  
       
    }


    /* #p_total
    {
        background-color: whitesmoke;
        color: black;
        text-align: center;
        font-weight: bold;
        width: 100px;
        font-size: 12px;
    } */


</style>
</head>
<body>
	<!--- MENSAGENS -->
   	<div class="container">
		<h3>Adicionar OS</h3>
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
			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Adicionar OS</strong> 
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
                    <div class="form-group col-md-6">
                        <div class="form-group col-md-6">
                                <button id="btn_calcularOS" 
                                        class="btn btn-primary" onclick="calcularOS()">Calcular</button>  
                        </div>  
                    </div>
                    <div class="row">
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
                    </div>
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