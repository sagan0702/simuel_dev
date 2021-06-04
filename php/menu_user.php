<!doctype html>
<html lang="pt-br">
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/jquery-ui.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script> 
  - <script src="js/jquery.mask.min.js"></script>  
    <script src="js/datepicker-pt-BR.js"></script>  
  
  

  <title>SIMUEL2</title>
</head>
<body>
<div class = "header">
  <div class="container">
      <div class="row">
        <h3> SIMUEL </h3> 
      </div>
      <div class="row">
        <h3> Sistema de Manutenção de Urnas Eletrônicas</h3>  
      </div>    
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../simuel/p_inicial.php">Inicial</a>
              </li>
              <li class="nav-item dropdown">  <!-------------- ITEM CICLOS --------------->
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Ciclos/OS
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="../simuel/ciclos.php">Ciclos</a></li>
                  <li><a class="dropdown-item" href="../simuel/os.php">OS</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown"> <!-------------- ITEM PRODUÇÃO --------------->
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Produção
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="../simuel/monitorar_producao.php">Gerenciar Produção</a></li>
                  <li><a class="dropdown-item" href="../simuel/producao_local.php">Produção NVI</a></li>
                  <li><a class="dropdown-item" href="../simuel/p_emissao_trd.php">Emissão TRD</a></li>    
                  <li><a class="dropdown-item" href="#">Utilitários</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown"> <!-------------- ITEM MONITORAMENTO --------------->
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Monitoramento 
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="../simuel/p_situacao.php">Situação</a></li>
                  <li><a class="dropdown-item" href="#">Painéis</a></li>
                  <li><a class="dropdown-item" href="../simuel/p_consultar_parque.php">Parque de Urnas</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown"> <!-------------- ITEM EMPRESA --------------->
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Empresa 
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="../simuel/p_emissao_dcs.php">Emissão da DCS</a></li>
                  <li><a class="dropdown-item" href="">Parque de Urnas</a></li>
                  <li><a class="dropdown-item" href="">Informações dos Locais</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown"> <!-------------- ITEM CONFIGURAÇÕES --------------->
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Configurações
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="../simuel/equipamentos.php">Cadastro de Equipamentos</a></li>
                  <li><a class="dropdown-item" href="../simuel/locais.php">Cadastro de Locais </a></li>
                  <li><a class="dropdown-item" href="../simuel/usuarios.php">Cadastro de Usuarios </a></li>
                  <li><a class="dropdown-item" href="../simuel/p_configuracoes.php">Configurações</a></li>
                  <li><a class="dropdown-item" href="../simuel/phpinfo.php">PHP Info</a></li>
                </ul>
              </li>
                  <li class="nav-item">
                <a class="nav-link " href="../simuel/php/logout.php"  tabindex="-1" aria-disabled="true">Sair</a>
              </li>
            </ul>
      </nav>
  </div>

</div>
</body>
</html>