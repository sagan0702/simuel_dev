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
        
        $dadosConexao = mysqli_get_host_info($conexao);
            if (!isset($_SESSION["usuario"])) {
                header('Location: index.php');
                exit();
            }
            include($_SESSION['menu']); 
    ?>

    <div class="container">
        <div class="row">
       
       
        <?php   
     
        ?>
         </div>
        <div class="row">
            <div class="form-group col-md-4">
            <br><label>O usuário logado é: </label> <?= $_SESSION['usuario'] ?> 
            </div>
            <div class="form-group col-md-4">
        </div>
            <div class="form-group col-md-4">
                <br><?php print_r($dadosConexao) ?> 
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
            
            </div>
            <div class="form-group col-md-4">
            </div>
            <div class="form-group col-md-4">
                <label for="campo2">Local:</label> <?= $_SESSION['local'] ?> 
            </div>
        </div>
       
   <!-- Example split danger button -->
        <div class="btn-group">
        <button type="button" class="btn btn-danger">Action</button>
        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Separated link</a></li>
        </ul>
        </div>


        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
  <button type="button" class="btn btn-primary">1</button>
  <button type="button" class="btn btn-primary">2</button>

  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      Dropdown
    </button>
    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <li><a class="dropdown-item" href="#">Dropdown link</a></li>
      <li><a class="dropdown-item" href="#">Dropdown link</a></li>
    </ul>
  </div>
</div>






        <footer>
                 
        </footer>
     
    </div>   
</body>
</html>