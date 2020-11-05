<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/planoAcao.php");

$IntegrantePlanoAcao = new IntegrantePlanoAcao();
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
		$data = date("Y-m-d");
		
//		$idPlanoAcao = $_REQUEST['idPlanoAcao'];
		$idIntegrantePlanoAcao = $_REQUEST['integrante'];
                
		$IntegrantePlanoAcao->setIdIntegrantePlanoAcao($idIntegrantePlanoAcao);
		$IntegrantePlanoAcao->updateFieldIntegrantePlanoAcao("aprovacaoAluno", $data);
		$IntegrantePlanoAcao->updateFieldIntegrantePlanoAcao("statusAprovacao", 1);
		
		echo "<div style=\"text-align:center\">Obrigado pelo aceite, já pode fechar essa janela!</div>";
		?>
    </div>
</body>
</html>



<?php 


?>