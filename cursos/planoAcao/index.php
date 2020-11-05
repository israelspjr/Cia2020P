<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/planoAcao.php");

$PlanoAcao = new PlanoAcao();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo NOME_APP?></title>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."include/css.php");
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."include/js.php");


?>

</head>

<body class="body" > 
    <div id="centro">
		<?php 
		
		$idPlanoAcao = Uteis::base64_url_decode($_GET['p']);
		$idIntegrantePlanoAcao = Uteis::base64_url_decode($_GET['b']);
		$area = Uteis::base64_url_decode($_GET['a']);
                
		$PlanoAcao->setIdPlanoAcao($idPlanoAcao);
		echo "<a href='planoAcaoExcel.php?idPlanoAcao=".$idPlanoAcao."&area=".$area."&integrante=".$idIntegrantePlanoAcao."' target='_blank'><button class=\"button blue\">Gerar Pdf</button></a>&nbsp;&nbsp;";
		
		
		echo $PlanoAcao->ImprimePlanoAcao($area, $idIntegrantePlanoAcao);
		?>
    </div>
</body>
</html>



<?php 


?>