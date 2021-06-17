<?php
include("conexao.php");

//print_r($_POST); 
var_dump($_POST); 
$id_ciclo= $_POST['id_ciclo'];
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
$estado = "1";


// $sql = "SELECT * FROM os where n_os = '$n_os' and id_ciclo = $id_ciclo";
$sql = "SELECT * FROM os where n_os = '$n_os' and id_ciclo = $id_ciclo";
$result = $conexao->query($sql);

if (mysqli_num_rows($result) > 0){
    exit("OS já existe.");
}
//converter para data br -> data mysql
$data_inicio = implode("-",array_reverse(explode("/",$data_inicio)));
$data_fim = implode("-",array_reverse(explode("/",$data_fim)));

//string de inserção
  $sqlInsertInto = "INSERT INTO os (id_ciclo, id_local, n_os,data_minima,data_maxima,t_urnas,t_baterias, qtde_ust, qtde_dias_periodo,qtde_dias_off, qtde_dias_disp, fp_diario, estado)
  
   VALUES ($id_ciclo,$id_local,'$n_os','$data_inicio','$data_fim',$t_urnas,$t_baterias,$ust, $qtde_dias_periodo,$qtde_dias_off, $qtde_dias_disp, $fp_diario, '$estado' )";

    if (!$conexao->query($sqlInsertInto)) {
        echo "Error: " . $sql . "<br>" . $conexao->error;
    }else{
        echo "Ordem de Serviço nº " . $n_os. " salva com sucesso!!!";        
    }

  //encerro a conexão com o banco de dados
  $conexao->close();

?>
