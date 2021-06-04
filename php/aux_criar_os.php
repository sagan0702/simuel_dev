<?php

include("conexao.php");

$hoje = date('Y-m-d');

//$sql = "SELECT * FROM ciclo where data_inicio <= '$hoje' and data_fim >= '$hoje' ";
$sql = "SELECT * FROM ciclo";
//exit ($sql);
$result = $conexao->query($sql);
$numRows = mysqli_num_rows($result);

if ($numRows > 0){
    while ($row = $result->fetch_assoc()) {
        
        $periodo = date('d/m/Y', strtotime($row["data_inicio"]))." a ".date('d/m/Y', strtotime($row["data_fim"]));
        $ciclo = substr($row["n_ciclo"], 0, 2)."/".substr($row["n_ciclo"], 3, 4);
        $id_ciclo = $row["id_ciclo"];
    }
    $campos = TRUE;
}else{
    $ciclo = "Sem Ciclo aberto";
    $id_ciclo = "";
    $campos = FALSE;
}

//preencher o combobox

$localCombo = "<option value='' selected>Selecione</option>";
$sql = "SELECT * FROM local";
$result = $conexao->query($sql);
while ($row = $result->fetch_assoc()) {
  
   //$localCombo .= "<option value='".$row["id_local"]."'>".$row["n_local"].  $row["qtde_infra"]."</option>";
   $localCombo .= "<option value='".$row["id_local"]."'>".$row["n_local"].  "</option>";
  
}

// pega o fator_producao_diario
$result = $conexao->query("SELECT prod_local FROM config where id_config = 1");
$fp_diario = mysqli_fetch_row($result);
$fp_diario = implode($fp_diario);


// pega o qinfraGA


$sql = mysqli_query($conexao,"SELECT id_local, n_local, qtde_infra FROM local");
 
while($linha = mysqli_fetch_array($sql)){
   $arrayIdLocal  = $linha["id_local"];
   $arrayNomeLocal = $linha["n_local"];
   $arrayQInfra= $linha["qtde_infra"];
   //echo "ID: $arrayIdLocal"." - "."Nome: $arrayNomeLocal"."Qinfra: $arrayQInfra"."<br>";
   //var_dump($linha );
}	



$conexao->close();

?>