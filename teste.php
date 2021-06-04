<link href="css/jquery-ui.css" rel="stylesheet" type="text/css"> 
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link rel="stylesheet" href="../css/bootstrap.min.css" >
<link rel="stylesheet" href="css/all.css" > 
<link rel="stylesheet" href="../css/all.css" > 
<link rel="stylesheet" href="../css/estilo.css" > 
<script src="js/bootstrap.min.js"></script>					
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js" ></script>
<!-- <script src="js/jquery.caret.js"></script> -->
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script src="../js/jquery.mask.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<input type="text" id="CPF" name="CPF" />

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
    $(document).ready(function () { 
        var $seuCampoCpf = $("#CPF");
        $seuCampoCpf.mask('000.000.000-00', {reverse: true});
    });
</script>

