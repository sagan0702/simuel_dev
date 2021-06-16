<?php
include('conexao.php');
session_start();

$local = $_SESSION['local'] ;
$id_local = $_SESSION['id_local'] ;
$sql = "SELECT MAX(id_ciclo), n_ciclo FROM ciclo ";
$result1 = mysqli_query($conexao,$sql);
if (mysqli_num_rows($result1) > 0){
    $max_id_ciclo = $row[0];
}
else {
  echo "SEM CICLO ABERTO";
    $max_id_ciclo = "0";
}


$sql = "SELECT n_ciclo FROM ciclo WHERE id_ciclo = $max_id_ciclo ";
$result2 = mysqli_query($conexao,$sql);
if (mysqli_num_rows($result2) > 0){
    $max_n_ciclo = $row[0];
}
else {
  echo "SEM CICLO ABERTO";
    $max_n_ciclo = "0";
}

//  echo "O id Ciclo máximo é :".$max_id_ciclo ;
//  echo "O Ciclo máximo é :" .$max_n_ciclo;
//  echo "O Local é :" .$local;
//  echo "O N Local é :" .$id_local;


$sql = "SELECT MAX(id_os), n_os FROM os WHERE id_local = '$id_local' ";
$result3 = mysqli_query($conexao,$sql);
if (mysqli_num_rows($result3) > 0){
    $max_id_os = $row[0];
}
else {
  echo "SEM OS ABERTA";
  $max_id_os = "0";
}

 
$sql = "SELECT n_os FROM os WHERE id_os = $max_id_os ";
$result4 = mysqli_query($conexao,$sql);
if (mysqli_num_rows($result4) > 0){
    $max_n_os = $row[0];
}
else {
  echo "SEM OS ABERTA";
  $max_n_os = "0";
}
    
    
 ///////////////   
    if (mysqli_num_rows($result) > 0){
        exit("OS já existe.");
    }
////////////////

 $_SESSION['max_id_ciclo'] = $max_id_ciclo;
 $_SESSION['max_n_ciclo'] = $max_n_ciclo;
 $_SESSION['max_id_os'] = $max_id_os;
 $_SESSION['max_n_os'] = $max_n_os;

   
//  echo "O id OS máximo é :".$max_id_os ;
//  echo "O Nº da OS máximo é :" .$max_n_os;
 
 mysqli_close($conexao);

?>













?>
