<?php

include_once('php/formatacao.php');
include ("php/bootstrapalert.php");

$conn = oci_connect('SIMUEL_OP', 'mtZVWPFZbcZQlPwOmlj5', 'srvoda1.tre-pb.gov.br/ADM');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$sql1 = "SELECT * FROM ASIWEB.VW_PB_PATRIMONIO WHERE LOCALIZACAO = 'NUCLEO DE VOTO INFORMATIZADO- NVI PATOS' AND MATERIAL = 'URNA ELETRONICA PARA VOTACAO' AND  MODELO = '2009'";
$stid = oci_parse($conn, $sql1);
oci_execute($stid);

// while (($row = oci_fetch_assoc($stid)) != false) {
//     echo $row['CD_PATRIMONIO'] . " " . $row['MATERIAL'] . "<br>\n";
// }

?>
    <h5 class="card-title"><i class="fa fa-th-list"></i></i> Equipamentos por local </h5>
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr class="bg-secondary text-white">
                    <td style="text-align: center;" >Patrimônio</td>		
                    <td style="text-align: center;" >Material</td>
                    <td style="text-align: center;" >Modelo</td>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                while (($row = oci_fetch_assoc($stid)) != false) {
                ?>
                <tr>
                    <td style="text-align: center;" ><?php  echo $row['CD_PATRIMONIO'];?></td>
                    <td style="text-align: center;" ><?php echo $row['MATERIAL'];?></td>
                    <td style="text-align: center;" ><?php echo $row['MODELO'];?></td>
                </tr>
            <?php } ?>          
            </tbody>
        </table>
<?php
oci_free_statement($stid);
oci_close($conn);