<!doctype html>
<html lang="pt-br">
<html>
<head>
<meta charset="UTF-8">
<!-- <script src="js/bootstrap.min.js" ></script> -->
<!-- <script src="../js/bootstrap.min.js" ></script> -->

<!-- <link href="css/bootstrap.min.css" rel="stylesheet" >
<link href="css/estilos.css" rel="stylesheet" >
<script src="js/popper.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script> 
<script src="js/bootstrap.bundle.min.js"></script>

<script src="js/jquery.mask.min.js"></script>  
<script src="js/datepicker-pt-BR.js"></script>  -->



<link href="../css/bootstrap.min.css" rel="stylesheet" >
<link href="../css/estilos.css" rel="stylesheet" >
<script src="../js/popper.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/jquery-ui.js"></script> 
<script src="../js/bootstrap.bundle.min.js"></script>

<script src="../js/jquery.mask.min.js"></script>
<script src="../js/datepicker-pt-BR.js"></script> 
<script type="text/javascript" src="https://www.google.com/jsapi"></script>


   
<title>SIMUEL2</title>
<style>
#div_local{
        background-color:whitesmoke;
        color: black;
        text-align: center;
        font-weight: bold;
        font-size: 22px;
        padding: 0, 0, 0, 0;
    }
</style>


</head>
<body>
<div class = "header">
<?php
        // session_start();
        include ("php/conexao.php");
        // include ("php/bootstrapalert.php");
        
        $dadosConexao = mysqli_get_host_info($conexao);
            if (!isset($_SESSION["usuario"])) {
                header('Location: ../index.php');
                exit();
            }
            // include($_SESSION['menu']); 
    ?>

        
  <div class="container">

      <div class="row">
              <h4> SIMUEL </h4> 
      </div>
      <div class="row">
      <!-- <div class="row justify-content-md-rigth"> -->
        <div class="col-sm-9">
          <h5> Sistema de Manutenção de Urnas Eletrônicas</h5>  
        </div>
        <div class="col-sm-1" id="div_data">
          <h6>  <?php echo date('d/m/Y') ?> <h6> 
        </div> 
        <div class="col-sm-1" id="div_local">
          <h6> <?= $_SESSION['local'] ?></h6>  
        </div> 
        <div class="col-sm-1" id="div_usuario">
          <h6> <?= $_SESSION['usuario']?></h6>  
        </div>
      </div>


      

    <div class="row">

      <!-- <div class="btn-group">
        <a href="p_inicial.php" class="btn btn-primary ">Inicio</a>
        <a href="ciclos.php" class="btn btn-primary ">Ciclos</a>
        <a href="os.php" class="btn btn-primary">OS</a>
        <a href="p_equipamentos.php" class="btn btn-primary">Equipamentos</a>
        <a href="producao_local.php" class="btn btn-primary">Enviar Produção</a>
        <a href="monitorar_producao.php" class="btn btn-primary">Monitoramento</a>
        <a href="p_configuracoes.php" class="btn btn-primary">Configurações</a>
        <a href="../simuel/php/logout.php" class="btn btn-primary">Sair</a>
        <a href="../simuel/php/logout.php" button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Ciclos</a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Separated link</a></li>
        </ul> -->

      <div class="btn-group">
          <a href="p_inicial.php" class="btn btn-primary ">Inicio</a>
          <a href="ciclos.php" class="btn btn-primary ">Ciclos</a>
          <a href="os.php" class="btn btn-primary">OS</a>
          <!-- <a href="producao_local.php" class="btn btn-primary">Produção</a> -->
        <div class="btn-group"  aria-label="Button group with nested dropdown">
        <!-- <div class="btn-group" > -->
              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Monitoramento
              </button>
              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <li><a class="dropdown-item" href="status.php">Status Total</a></li>
                <li><a class="dropdown-item" href="monitorar_producao.php">Consultar Produção Enviada</a></li>
                <li><a class="dropdown-item" href="#">Consultas</a></li>
              </ul>
        <!-- </div> -->
        <!-- <div class="btn-group" role="group"> -->
        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Consultas
              </button>
              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <li><a class="dropdown-item" href="parque.php">Parque de Urnas</a></li>  
                <li><a class="dropdown-item" href="andamento_STE.php">Acompanhamento STE</a></li>
                <li><a class="dropdown-item" href="cadastro_nvi_ze.php">NVI x Zonas</a></li>
              </ul>

              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Cadastros
              </button>
              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <li><a class="dropdown-item" href="locais.php">Locais</a></li>  
                <li><a class="dropdown-item" href="usuarios.php">Usuários</a></li>
                <li><a class="dropdown-item" href="equipamentos.php">Equipamentos</a></li>
              </ul>

              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Configurações
              </button>
              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <li><a class="dropdown-item" href="manutencao.php">Manutenção</a></li>  
                <li><a class="dropdown-item" href="parametros.php">Parâmetros</a></li>  
                <li><a class="dropdown-item" href="php_info.php">PHP Info</a></li>
              </ul>
        </div>
        <a href="../simuel/php/logout.php" class="btn btn-primary">Sair</a>
      </div>


    </div>

      
    
  </div>
</div>
</body>
</html>