<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/js.php");
require_once($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/css_area.php");

$TipoDocumentoUnico = new TipoDocumentoUnico();

$documento = $_REQUEST['documentoUnico'];
$password = EncryptSenha::B64_Encode($_REQUEST['password']);
$tipo = $_REQUEST['tipoDocumentoUnico_idTipoDocumentoUnico'];
$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];
$responderPsa = $_REQUEST['responderPsa'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

if ($tipo == 1) {
	
	$_SESSION['tipo'] = 1;
	
} elseif ($tipo == 2) {
	$_SESSION['tipo'] = 2;
}
if ($_SESSION['tipo'] >= 1) {
$_SESSION['idIntegranteGrupo'] = $idIntegranteGrupo;
$_SESSION['idFolhaFrequencia'] = $idFolhaFrequencia;

}
if ($responderPsa == 1) {
$_SESSION['responderPsa'] = 1;	
$_SESSION['idPlanoAcaoGrupo'] = $idPlanoAcaoGrupo;
	
}

if ($documento != '' && $password != '') {
	if (!$Login -> efetuarLogin_Aluno($documento, $password)) {		
		Uteis::alertJava("Login ou senha inválidos.", true);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php //echo NOME_APP ?></title>
    
<!--<link href="../config/css/bootstrap.min.css" rel="stylesheet">
<link href="../config/css/datepicker3.css" rel="stylesheet">
<link href="../config/css/styles.css" rel="stylesheet">
-->
<!--<link href="<?php echo CAMINHO_CFG?>css/jquery/jquery-ui.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo CAMINHO_CFG?>js/login.js" language="javascript" type="text/javascript"></script>
-->
<style>
	body{
		background-image: url("../images/bcgaluno2.jpg");
	}
</style>
</head>

<body>
<p>&nbsp;</p>
<div id="divs_jquery"></div>
<div id="alertas"></div>
	<div class="row">
		<div style="width:100%;    padding: 10px;">
			<div class="login-panel panel panel-default">
				<!--<div class="panel-heading">Log in</div>-->
				<div class="panel-body">
    <form id="login" class="validate" action="recuperaSenha.php" method="post" >
      <p><strong>Área do aluno</strong></p> 
      <p><div class="form-group">
                <label>Documento:</label>
                <?php //echo $TipoDocumentoUnico->selectTipoDocumentoUnicoSelect($teraDocumentoUnico, 1); //$tipoDocumentoUnicoIdTipoDocumentoUnico);?>
                <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
            </div>
            </p>
             <p><div class="form-group">
                <label>Nº Documento:(digite apenas numeros e letras)</label>
                <input type="text" name="documentoUnico" id="documentoUnico" class="required form-control cpf"
                       value="<?php echo $login_temp ?>" autocomplete="off" />
                <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
                </div>
                </p>
                 <p>
            <div class="form-group">
                <label>Defina uma nova senha.</label>
                <input type="password" name="password" id="password"  value="<?php echo $senha_temp ?>"
                       autocomplete="off" class="required form-control"/>
                <span class="placeholder" style="display:none;color:red;" >Campo Obrigatório</span>
                <input type="checkbox" value="1" onclick="mostraSenha(this)"/>
                <small>mostrar a senha</small>
                </div>
            </p>
        <p><div class="form-group">
            <label>Data de Nascimento</label>
            <input type="text" name="nasc" id="nasc" class="required data form-control" value="<?php echo $senha_temp?>" autocomplete="off" />
            <span class="placeholder" style="display:none;color:red;" >Campo Obrigatório</span>
            </div>
        </p>
        
      <p>
        <button class="bBlue">Enviar dados</button>
        <p><a href="login.php">Voltar ao Login!</a></p>
         <!--<p onClick="mensagem(); enviarSenha(redefSenha(),'#cpf', 'aluno')" class="onlink" >
         <p>Não sabe a sua senha? Entre em contato com a companhia (11) 5061-0117 </p>-->
      </p>
    </form>
    <script>
	function mensagem() {
	    alert("Sua senha foi enviada para o e-mail cadastrado.");
	}
	$('#documentoUnico').focus();
    <?php if(isset($_GET['msg'])) { ?>
        alert('- Nrº do Documento ou Data de Nascimento inválidos!');
    <?php } ?>
    </script>
  </div>
</div>
</body>
</html>
<script>ativarForm();</script>