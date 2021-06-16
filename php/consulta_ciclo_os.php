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

 $sql = "SELECT MAX(id_os), n_os FROM os WHERE id_local = '$id_local' ";
 $result2 = mysqli_query($conexao,$sql);
 $row = mysqli_fetch_row($result2);
 $max_id_os = $row[0];
 
 $sql = "SELECT n_os FROM os WHERE id_os = '$max_id_os' ";
 $result3 = mysqli_query($conexao,$sql);
 $row = mysqli_fetch_row($result3);
 $max_n_os = $row[0];

 $sql = "SELECT t_urnas FROM os WHERE id_local = '1' AND id_os = '$max_id_os'";
 $result = mysqli_query($conexao,$sql);
 $row = mysqli_fetch_row($result);
 //var_dump($row);
 $t_urna_os_1 = $row[0];
 //var_dump($t_urna_os_1);



$_SESSION['max_id_ciclo'] = $max_id_ciclo;
$_SESSION['max_n_ciclo'] = $max_n_ciclo;
$_SESSION['max_id_os'] = $max_id_os;
$_SESSION['max_n_os'] = $max_n_os;
// $_SESSION['tn_os'] = $max_n_os;



// echo "O id OS máximo é :".$max_id_os ;
// echo "" ;
// echo "O Nº da OS máximo é :" .$max_n_os;
// echo "O id Ciclo máximo é :".$max_id_ciclo ;
// echo "O Ciclo máximo é :" .$max_n_ciclo;
// echo "O Local é :" .$local;
// echo "O N Local é :" .$id_local;
// echo "O N Local é :" .$id_local;

mysqli_close($conexao);

?>














