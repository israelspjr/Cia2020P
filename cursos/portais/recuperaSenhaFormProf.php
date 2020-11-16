<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/js.php");
require_once($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/css_area.php");

$Configuracoes = new Configuracoes();

$config = $Configuracoes->selectConfig();

$TipoDocumentoUnico = new TipoDocumentoUnico();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <div class="header">
 			 <center> <img src="../upload/imagem/empresa/<?php echo $config[0]['logo'];?>" alt="logo" class="logo"/></center>
	</div>	
    <title><?php //echo NOME_APP ?></title>
    <style>
	body{
		background-image: url("../images/bcgprof.jpg");
	}
</style>
<link rel="shortcut icon" href="../upload/imagem/empresa/<?php echo $config[0]['favIcon'];?>">
</head>
<body>
<div id="divs_jquery"></div>
<div id="alertas"></div>
	<div class="row">
		<div style="width:100%;    padding: 10px;">
			<div class="login-panel panel panel-default">
            <div class="panel-body">
    <form id="login" class="validate" action="recuperaSenhaProf.php" method="post" >
      <p><strong>Área do professor</strong></p> 
      <p><div class="form-group">
                <label>Documento:</label>
                <?php echo $TipoDocumentoUnico->selectTipoDocumentoUnicoSelect($teraDocumentoUnico, 1); //$tipoDocumentoUnicoIdTipoDocumentoUnico);?>
                <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
            </div>
            </p>
       <p><div class="form-group">
                <label>Nº Documento:(digite apenas numeros e letras)</label>
                <input type="text" name="documentoUnico" id="documentoUnico" class="required form-control"
                       value="<?php echo $login_temp ?>" autocomplete="off" />
                <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
                </div>
                </p>
        <p><div class="form-group">
            <label>Data de Nascimento</label>
            <input type="text" name="nasc" id="nasc" class="required data form-control" value="<?php echo $senha_temp?>" autocomplete="off" />
            <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
       </div> </p>
      <p><div class="form-group">
        <label>Senha</label>
        <input type="password" name="password" id="password"  class="required form-control" value="<?php echo $senha_temp?>" autocomplete="off" />
        <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span> 
        <input type="checkbox" value="1" onclick="mostraSenha(this)" /><small>mostrar a senha</small>
        </div></p>
      <p><div class="form-group">
        <button class="button blue submit">Gravar nova senha</button></div>
        </p>
        <p><a href="login.php?app=2">Voltar ao Login!</a></p>
    </form>
    <script type="text/javascript">
        $('#documentoUnico').focus();
	    tipoDocumentoUnico("login");
        $('#tipoDocumentoUnico_idTipoDocumentoUnico').attr('onchange','tipoDocumentoUnico("login")')
        <?php if(isset($_GET['msg'])) { ?>
            alert('- Nrº do Documento ou Data de Nascimento inválidos!');
        <?php } ?>
    </script>
  </div>
</div>
</div>
</div>
</body>
</html>
<script>ativarForm();</script>