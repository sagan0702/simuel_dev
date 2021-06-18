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
        include_once('php/formatacao.php');
        // include ("php/bootstrapalert.php");
        
        
            if (!isset($_SESSION["usuario"])) {
                header('Location: index.php');
                exit();
            }
            include($_SESSION['menu2']); 
    ?>

    <div class="container">
       
        <?php    phpinfo(); ?>

        <footer>
        </footer>
     
    </div>   
</body>
</html>