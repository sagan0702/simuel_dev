<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicial-ADM</title>


</style>
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
            
		    //echo $id_local;
	
	
	
	//CONSULTA PARQUE DE URNAS DE TODOS LOCAIS

    
?>
	
</body>
</html>