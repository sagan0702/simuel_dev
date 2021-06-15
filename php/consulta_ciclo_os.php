<?php
include('conexao.php');
session_start();

 $local = $_SESSION['local'] ;
 $id_local = $_SESSION['id_local'] ;
 
 $sql = "SELECT MAX(id_ciclo), n_ciclo FROM ciclo ";
 $result = mysqli_query($conexao,$sql);
 $row = mysqli_fetch_row($result);
 $max_id_ciclo = $row[0];
 
 $sql = "SELECT n_ciclo FROM ciclo WHERE id_ciclo = $max_id_ciclo ";
 $result = mysqli_query($conexao,$sql);
 $row = mysqli_fetch_row($result);
 $max_n_ciclo = $row[0];

//  echo "O id Ciclo máximo é :".$max_id_ciclo ;
//  echo "O Ciclo máximo é :" .$max_n_ciclo;
//  echo "O Local é :" .$local;
//  echo "O N Local é :" .$id_local;



 $sql2 = "SELECT MAX(id_os), n_os FROM os WHERE id_local = '$id_local' ";
 $result2 = mysqli_query($conexao,$sql2);
 $row = mysqli_fetch_row($result2);
 $max_id_os = $row[0];
 
 $sql3 = "SELECT n_os FROM os WHERE id_os = $max_id_os ";
 $result3 = mysqli_query($conexao,$sql3);
 $row = mysqli_fetch_row($result3);
 //$max_n_os = $row[0];
 if ($result3 = "0" ) {
     echo "NÃO EXISTEM ORDENS DE SERVIÇO ABERTAS PARA SEU LOCAL"   ;
 } else {
    $max_n_os = $row[0];
    $_SESSION['max_id_ciclo'] = $max_id_ciclo;
    $_SESSION['max_n_ciclo'] = $max_n_ciclo;
    $_SESSION['max_id_os'] = $max_id_os;
    $_SESSION['max_n_os'] = $max_n_os;

 } 

//  echo "O id OS máximo é :".$max_id_os ;
//  echo "O Nº da OS máximo é :" .$max_n_os;
 



 mysqli_close($conexao);

?>













?>
