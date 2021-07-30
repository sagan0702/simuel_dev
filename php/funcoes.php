<?php
// include('conexao.php');
// session_start();

//  $local = $_SESSION['local'] ;
//  $id_local = $_SESSION['id_local'] ;


function identifica_ciclo ($id_ciclo) {
    include('conexao.php');
    //session_start();  
    $sql = "SELECT n_ciclo FROM ciclo WHERE id_ciclo = $id_ciclo";
    $result = mysqli_query($conexao,$sql);
    $row = mysqli_fetch_row($result);
    $ciclo_result = $row[0];
    if ($ciclo_result == 0) {
            
        return  $ciclo_result = "N/A";
    } else {
        return  $ciclo_result;
    }
    mysqli_close($conexao);
}

function identifica_os ($id_os) {
    include('conexao.php');
    //session_start();  
    $sql = "SELECT n_os FROM os WHERE id_os = $id_os";
    $result = mysqli_query($conexao,$sql);
    $row = mysqli_fetch_row($result);
    $os_result = $row[0];
    if ($os_result == 0) {
            
        return  $os_result = "N/A";
    } else {
        return  $os_result;
    }

    mysqli_close($conexao);
}

function identifica_local ($id_local) {
    include('conexao.php');
    //session_start();  
    $sql = "SELECT n_local FROM local WHERE id_local = $id_local";
    $result = mysqli_query($conexao,$sql);
    $row = mysqli_fetch_row($result);
    $local_result = $row[0];
    if ($local_result == 0) {
            
        return  $local_result = "N/A";
    } else {
        return  $local_result;
    }
    mysqli_close($conexao);
}


function identifica_usuario ($id_usuario) {
    include('conexao.php');
    //session_start();  
    $sql = "SELECT usuario FROM usuarios WHERE id_usuario = $id_usuario";
    $result = mysqli_query($conexao,$sql);
    $row = mysqli_fetch_row($result);
    $local_result = $row[0];
        if ($local_result == 0) {
            
            return  $usuario_result = "N/A";
        } else {
            return  $usuario_result;
        }
   
    mysqli_close($conexao);
}



function max_ciclo () {
    include('conexao.php');
    $sql = "SELECT MAX(id_ciclo), n_ciclo FROM ciclo";
    $result = mysqli_query($conexao,$sql);
    $row = mysqli_fetch_row($result);
    $max_n_ciclo = $row[1];
        if ($max_n_ciclo == 0) {
            $max_n_ciclo = "N/A";
        } else {
            $max_n_ciclo = $row[1];
        }
        return $max_n_ciclo;    
 
    mysqli_close($conexao);
}


function max_id_ciclo () {
    include('conexao.php');
    $sql = "SELECT MAX(id_ciclo), n_ciclo FROM ciclo";
    $result = mysqli_query($conexao,$sql);
    $row = mysqli_fetch_row($result);
    $max_id_ciclo = $row[0];
        if ( $max_id_ciclo == 0) {
            $max_id_ciclo = "N/A";
        } else {
            $max_id_ciclo = $row[0];
        }

        return $max_id_ciclo;
    mysqli_close($conexao);
}


function max_os () {
    include('conexao.php');
    $sql = "SELECT MAX(id_os), n_os FROM os ";
    $result2 = mysqli_query($conexao,$sql);
    $row = mysqli_fetch_row($result2);
    $max_n_os = $row[1];
    if ( $max_n_os == "") {
        $max_n_os = "N/A";
    } else {
        $max_n_os = $row[1];
    }
    return   $max_n_os;
    mysqli_close($conexao);
}


function max_id_os () {
    include('conexao.php');
    $sql = "SELECT MAX(id_os), n_os FROM os ";
    $result2 = mysqli_query($conexao,$sql);
    $row = mysqli_fetch_row($result2);
    $max_id_os = $row[0];
    $max_n_os = $row[1];
    
    if ( $max_id_os == 0) {
                
        $max_id_os = "N/A";
        $max_n_os = "N/A";

    } else {
        $max_id_os = $row[0];
        $max_n_os = $row[1];
        return  $max_id_ciclo."-".$max_n_ciclo;
    }

}



// function max_ciclo_local ($id_local) {
//     include('conexao.php');
//     $sql = "SELECT MAX(id_ciclo), n_ciclo FROM ciclo  WHERE id_local = $id_local";
//     $result = mysqli_query($conexao,$sql);
//     $row = mysqli_fetch_row($result);
//     $max_id_ciclo_local = $row[0];
//     $max_n_ciclo_local = $row[1];
//     return  $max_id_ciclo_local."-".$max_n_ciclo_local;
     

// }

function max_os_local ($id_loc) {
    include('conexao.php');
    $sql = "SELECT MAX(id_os), n_os, id_ciclo FROM os WHERE id_local = $id_loc";
    $result = mysqli_query($conexao,$sql);
    $row = mysqli_fetch_row($result);
    // $max_id_os_local = $row[0];
    $max_n_os_local = $row[1];
    // $max_id_ciclo_local = $row[2];
    // $sql = "SELECT n_ciclo FROM ciclo  WHERE id_ciclo = $max_id_ciclo_local";
    // $result = mysqli_query($conexao,$sql);
    // $row = mysqli_fetch_row($result);
    //$max_n_ciclo_local = $row[0];
    // return $max_id_os_local."-".$max_n_os_local."-".$max_n_ciclo_local;
    
    return $max_n_os_local;
    

    $sql = "SELECT n_os FROM os WHERE id_os = '$max_id_os' ";
    $result3 = mysqli_query($conexao,$sql);
    $row = mysqli_fetch_row($result3);
    $max_n_os = $row[0];

}


function data ($entrada) {
   $data = implode("/",array_reverse(explode("-",$entrada)));;
   return  $data;

}

function hora ($entrada) {
    $hora =  substr(data($entrada),10, 9); 
    return $hora;
}



//converter para data br -> data mysql

//Se você quer converter uma data vinda do MYSQL para o formato PT-BR use o seguinte comando:

// $data = implode("/",array_reverse(explode("-",$data)));

//Ex: 2010-31-04 para 31/04/2010


// Se você quer converter uma data em formato brasileiro para inserir no mysql use:

//     $data = implode("-",array_reverse(explode("/",$data)));
//     O resultado será: 31/04/2010 para 2010-31-04


function data_br_mysql ($data) {
    $data_mysql = implode("-",array_reverse(explode("/",$data)));
    return $data;
}

function data_mysql_br ($data) {
    $data = implode("/",array_reverse(explode("-",$data)));
    return $data;
}


?>














