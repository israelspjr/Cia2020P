<?php
$pgLogin = true;
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."include/css.php");
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."include/js.php");

$Configuracoes = new Configuracoes();

$config = $Configuracoes->selectConfig();

if(($_POST['cpf'] != '') && ($_POST['password'] != '')){	
	echo "teste";
	if(!$Login->efetuarLogin($_POST['cpf'], EncryptSenha::B64_Encode($_POST['password']))){ 			
		Uteis::alertJava("Login ou senha inválidos.", true);
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo NOME_APP?></title>
<style>
	body{
		background-image: url("../images/bcgrh.jpg");
	}
</style>
<script src="<?php echo CAMINHO_CFG ?>js/login.js" language="javascript" type="text/javascript"></script>
</head>

<body>
<div class="header">
 			 <center> <img src="../upload/imagem/empresa/<?php echo $config[0]['logo'];?>" alt="logo" class="logo"/></center>
	</div>	
	<div id="divs_jquery"> </div>
	<div id="centro"> <br />
    <div id="alertas"></div>
  
  <!--<div class="row">-->
		<div style="width:100%;    padding: 10px;">
			<div class="login-panel panel panel-default">
          			<div class="toplogin">Área administrativa</div>
	
				<div class="panel-body">
 
     <form id="login" class="validate" action="login.php" method="post" >
       
      <p><div class="form-group">
        <label>CPF:</label>
        <input type="text" name="cpf" id="cpf" class="required cpf" value="<?php echo $login_temp?>" autocomplete="off" />
        <span class="placeholder">Campo Obrigatório</span> 
        </div>
      </p>
      
      
      <p><div class="form-group">
        <label>Senha</label>        
        <input type="password" name="password" id="password" class="required" value="<?php echo $senha_temp?>" autocomplete="off" />
        <span class="placeholder">Campo Obrigatório</span> 
        <input type="checkbox" value="1" onclick="mostraSenha(this)" /><small>mostrar a senha</small>
        </div>
      </p>
      <p><div class="form-group">
        <button class="button blue submit">Efetuar Login</button>
        </div>
      </p>
      <p onClick="confirmar();"  class="onlink" >Não sabe a sua senha?</p> 
      <!--mensagem(); enviarSenha(redefSenha(),'#cpf', 'admin')"-->
    </form>
     			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
    <script>
	function confirmar() {
	var r = confirm("Tem certeza que deseja resetar a senha e receber no seu email? ");
	if(r == true) {
		mensagem();
		enviarSenha(redefSenha(),'#cpf', 'admin');
		}
	}

	function mensagem() {
	alert("Sua senha foi enviada para o e-mail cadastrado.");
		
	}
	$('#documento').focus();</script> 
  </div>
</div>
</body>
</html>
<script>
	ativarForm();
</script>