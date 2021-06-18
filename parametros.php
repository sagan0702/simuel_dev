<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Parâmetros de sistema</title>
    
</head>
<body>
    <?php
    	include_once('php/formatacao.php');
        session_start();
        include ("php/conexao.php");
        // include ("php/bootstrapalert.php");
        
       
            if (!isset($_SESSION["usuario"])) {
                header('Location: index.php');
                exit();
            }
            include($_SESSION['menu2']); 
    ?>

    <div class="container">
        <div class="row">
       
       
        <?php   
     
        ?>
         </div>
        <div class="row">
            <div class="form-group col-md-9">
            <br><label>O usuário logado é: </label> <?= $_SESSION['usuario'] ?> 
            </div>
         
            <div class="form-group col-md-3">
                <br><?php print_r($dadosConexao) ?> 
            </div>
        </div>
       

        <footer>
        </footer>
     
    </div>   
</body>
</html>