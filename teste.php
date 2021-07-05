<?php

// $pwd = getenv("USERPROFILE");
// echo $pwd;
$conn = oci_connect('SIMUEL_OP', 'mtZVWPFZbcZQlPwOmlj5', 'srvoda1.tre-pb.gov.br/ADM');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
//$sql1 = 'SELECT CD_PATRIMONIO, MATERIAL FROM ASIWEB.VW_PB_PATRIMONIO WHERE ROWNUM <= 10' ;
// $sql1 = 'SELECT CD_PATRIMONIO, MATERIAL FROM ASIWEB.VW_PB_PATRIMONIO WHERE LOCALIZACAO =  \'SECAO DE COMPRAS\' ' ;
$sql1 = "SELECT CD_PATRIMONIO, MATERIAL FROM ASIWEB.VW_PB_PATRIMONIO WHERE LOCALIZACAO =  'SECAO DE COMPRAS' " ;
$stid = oci_parse($conn, $sql1);
oci_execute($stid);
//SELECT * FROM ASIWEB.VW_PB_PATRIMONIO WHERE LOCALIZACAO = 'SECAO DE COMPRAS';
while (($row = oci_fetch_assoc($stid)) != false) {
    echo $row['CD_PATRIMONIO'] . " " . $row['MATERIAL'] . "<br>\n";
}

oci_free_statement($stid);
oci_close($conn);

