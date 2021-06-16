<?php
include('php/conexao.php');
session_start();



$n_local_os = $_POST['qinfratext'];

//  qinfra = 128
//  id_local = 1

 $sql = "SELECT  qinfra, id_local FROM local WHERE n_local = $n_local_os ";
 $result = mysqli_query($conexao,$sql);
 $row = mysqli_fetch_row($result);
 $qinfra = $row[0];
 $id_local = $row[1];



echo "O valor de $qinfra é :".$qinfra ;
echo "O valor de $id_local é :".$id_local ;

mysqli_close($conexao);

?>
