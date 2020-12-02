<?php
$pgaluno = true;
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");
require_once($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/js_area.php");

$documento = $_REQUEST['nome'];
$password = $_REQUEST['password'];
if ($documento != '' && $password != '') {
	if (!$Login -> efetuarLogin_pre($documento, $password)) {		
		Uteis::alertJava("Login ou senha inválidos.", true);
	}
}

$login_temp = trim($_REQUEST['nomeExibicao']);
$senha_temp = trim($_REQUEST['email']);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo NOME_APP ?></title>
    
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/datepicker3.css" rel="stylesheet">
<link href="../css/styles.css" rel="stylesheet">

<?php
//	require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/css_area.php");
?>

<?php
//	require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/js_area.php");
?>
<script src="<?php echo CAMINHO_CFG?>js/login.js" language="javascript" type="text/javascript"></script>
<script src="../js/bootstrap-datepicker.pt-BR.js" language="javascript" type="text/javascript"></script>

</head>

<body>
<div id="divs_jquery"></div>
<div id="alertas"></div>
	<div class="row">
		<div style="width:100%;    padding: 10px;">
			<div class="login-panel panel panel-default">
				<!--<div class="panel-heading">Log in</div>-->
				<div class="panel-body">
    <form id="login" class="validate" action="precadastro.php" method="post" >
      <p><strong>Pré cadastro do aluno</strong></p> 
      <p><div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" class="required form-control" value="<?php echo $login_temp?>" autocomplete="off" />
        <span class="placeholder" style="display:none;color:red;" >Campo Obrigatório</span></div> </p>
      <p><div class="form-group">
        <label>Email:</label>
        <input type="text" name="password" id="password"  class="required form-control" value="<?php echo $senha_temp?>" autocomplete="off" />
        <span class="placeholder" style="display:none;color:red;" >Campo Obrigatório</span>
        </div></p>
        <input type="hidden" id="preCadastro" name="preCadastro" value="1" />
        <p>
    <!--    <input type="checkbox" value="1" onclick="mostraSenha(this)" /><small>mostrar a senha</small></p>-->
      <p><div class="form-group">
        <button class="Bblue submit">Efetuar Login</button>
        </div>
        </p>
        <!-- <p onClick="enviarSenha(redefSenha(),'#cpf', 'aluno')" class="onlink" >Não sabe a sua senha?</p> 
      </p>-->
    </form>
    <script>//$('#cpf').focus();</script> 
			</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
</body>
</html>
<script>ativarForm();</script>