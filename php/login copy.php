<?php
session_start();
include('conexao.php');

if(empty($_POST['usuario']) || empty($_POST['senha'])) {
	header('Location: index.php');
	exit();
}
$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
$query = "SELECT u.id_usuario, u.usuario, u.email, u.id_local, u.acesso, l.n_local  FROM usuarios u 
INNER JOIN local l ON l.id_local = u.id_local
WHERE usuario = '{$usuario}' AND senha = '{$senha}'";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

while ($campo = $result->fetch_assoc()) {
    
    $id = $campo['id_usuario'];
    $usuario = $campo['usuario'];
    $email = $campo['email'];
    $id_local = $campo['id_local'];
    $acesso = $campo['acesso'];
    $local = $campo['n_local'];
    
}
//print_r($_POST); 


if($row == 1) {
	$_SESSION['usuario'] = $usuario;
	$_SESSION['id_usuario'] = $id;
    $_SESSION['id_local'] = $id_local;
	$_SESSION['local'] = $local;
    $_SESSION["qtde_infra"] = $qtde_infra;
    $_SESSION["nivel_acesso"] = $acesso;
	
        if ($acesso == 1){
            $_SESSION["menu"]='php/menu_adm.php';
            $_SESSION["menu2"]='php/menu_adm2.php';
            header('Location: /simuel/p_inicial_adm.php');
        }else{
            $_SESSION["menu"]='php/menu_user.php';
            $_SESSION["menu2"]='php/menu_user2.php';
            header('Location: /simuel/p_inicial.php');
        }
	
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: ../index.php');
	exit();
}

 

?>
