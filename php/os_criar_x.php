<?php
include("conexao.php");
//print_r($_POST); 
//var_dump($_POST); 
//$id_ciclost= $_POST['id_ciclo'];
$id_ciclo = $_POST['id_ciclo'];
$id_local= $_POST['id_local'];
$n_os = $_POST['n_os'];
$data_inicio = $_POST['inicio'];
$data_fim = $_POST['fim'];
$t_urnas = $_POST['turnas'];
$t_baterias = $_POST['tbaterias'];
$qtde_dias_periodo= $_POST['qtde_dias_periodo'];
$qtde_dias_off= $_POST['qtde_dias_off'];
$qtde_dias_disp= $_POST['qtde_dias_disp'];
$fp_diario= $_POST['fp_diario'];
$ust= $_POST['ust'];
$qtde_ga= $_POST['qtde_ga'];
$ga651 = $_POST['ga651'];
$ga652 = $_POST['ga652'];
$ga653 = $_POST['ga653'];
$ga654 = $_POST['ga654'];
$ga655 = $_POST['ga655'];
$ga656 = $_POST['ga656'];
$ga657 = $_POST['ga657'];
$ga658 = $_POST['ga658'];
$ga659 = $_POST['ga659'];
$ga6510 = $_POST['ga6510'];
$ga6511 = $_POST['ga6511'];
$ga6512 = $_POST['ga6512'];
$ga6513 = $_POST['ga6513'];
$ga6514 = $_POST['ga6514'];
$ga6515 = $_POST['ga6515'];
$ga6516 = $_POST['ga6516'];
$ga6517 = $_POST['ga6517'];
$ga6518 = $_POST['ga6518'];
$ga6519 = $_POST['ga6519'];
$ga6520 = $_POST['ga6520'];
$ga661 = $_POST['ga661'];
$ga662 = $_POST['ga662'];
$ga663 = $_POST['ga663'];
$ga664 = $_POST['ga664'];
$ga665 = $_POST['ga665'];
$ga666 = $_POST['ga666'];
$estado = "1";
//$id_ciclo = intval($id_ciclost);
//echo "Dump de n_os- ";
//var_dump ($n_os);

$sql = "SELECT * FROM os where n_os = '$n_os' and id_ciclo = $id_ciclo";
$result = $conexao->query($sql);

if (mysqli_num_rows($result) > 0){
    exit("Erro: A OS informada já existe.");
} else {



//converter para data br -> data mysql
$data_inicio = implode("-",array_reverse(explode("/",$data_inicio)));
$data_fim = implode("-",array_reverse(explode("/",$data_fim)));

//INSERIR DADOS NA TABELA OS
  
  $sql_os = "INSERT INTO os (id_ciclo, id_local, n_os,data_minima,data_maxima,t_urnas,t_baterias, qtde_ust, qtde_dias_periodo, qtde_dias_off, qtde_dias_disp, fp_diario, estado, ga651, ga652, ga653, ga654, ga655, ga656, ga657, ga658, ga659, ga6510, ga6511, ga6512, ga6513, ga6514, ga6515,
  ga6516, ga6517,ga6518, ga6519, ga6520, ga661, ga662, ga663, ga664, ga665, ga666) 
  VALUES ($id_ciclo,$id_local,'$n_os','$data_inicio','$data_fim',$t_urnas,$t_baterias,$ust, $qtde_dias_periodo,$qtde_dias_off, $qtde_dias_disp, $fp_diario, '$estado', $ga651, $ga652, $ga653, $ga654, $ga655, $ga656, $ga657, $ga658, $ga659, $ga6510, $ga6511, $ga6512, $ga6513, $ga6514,$ga6515, $ga6516, $ga6517, $ga6518, $ga6519, $ga6520, $ga661, $ga662, $ga663, $ga664, $ga665, $ga666 )";

  if (!$conexao->query($sql_os)) {
    echo "Error: " . $sql . "<br>" . $conexao->error;
  }else{
    echo "Ordem de Serviço nº " .$n_os. " salva com sucesso!!!";    
    // header('location: /simuel_dev/os.php?msg=ras');   
    // exit; 
  }
  
//INSERIR QUANTIDADE INICIAL DE BATERIAS NA TABELA STATUS
  // $sql = "INSERT INTO status (id_local, tbat_reserva) 
  // VALUES ($id_local,$t_baterias)";  

  //   if (!$conexao->query($sql)) {
  //       echo "Error: " . $sql . "<br>" . $conexao->error;
  //   }else{
  //       echo "Ordem de Serviço nº " .$n_os. " salva com sucesso!!!";    
  //       // header('location: /simuel_dev/os.php?msg=ras');   
  //       // exit; 
  //   }


  $conexao->close();
}
?>
