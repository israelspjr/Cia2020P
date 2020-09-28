<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");
require_once($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/js.php");
require_once($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/css_area.php");

$Configuracoes = new Configuracoes();

$config = $Configuracoes->selectConfig();

$TipoDocumentoUnico = new TipoDocumentoUnico();

//$FolhaFrequencia = new FolhaFrequencia();

//$password = $_REQUEST['password'];
$password = EncryptSenha::B64_Encode($_REQUEST['password']);
$documento = $_REQUEST['documentoUnico'];
$senha_temp = $password2;
$CPF = $_REQUEST['cpf'];
$appN = $_REQUEST['app'];
//echo $appN;

if ($documento == '') {
	$documento = $CPF;	
}

if ($documento == '') {
	$documento = $_POST['cnpj'];
}


$tipo = $_REQUEST['tipoDocumentoUnico_idTipoDocumentoUnico'];
$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];
$responderPsa = $_REQUEST['responderPsa'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

if ($appN == 1) {
	$app = "Aluno";	

if ($_SESSION['tipo'] >= 1) {
	$_SESSION['idIntegranteGrupo'] = $idIntegranteGrupo;
	$_SESSION['idFolhaFrequencia'] = $idFolhaFrequencia;

}
if ($responderPsa == 1) {
	$_SESSION['responderPsa'] = 1;	
	$_SESSION['idPlanoAcaoGrupo'] = $idPlanoAcaoGrupo;
	
}

if ($documento != '' && $password != '') {
//	echo $documento;
//	echo $password;
	if (!$Login -> efetuarLogin_Aluno($documento, $password, 1, 1)) {		
		Uteis::alertJava("Login ou senha inválidos.", true);
	}
}

} elseif ($appN == 2) {
	$app = "Professor";
	
	$novo = $_REQUEST['novo'];
	if  (($novo != '') || ($novo == 1)) {
		$Login->efetuarLogin_Prof($documento, $password, $tipo, 1, 1);
	} else {
		if ($documento != '' && $password != '' && $tipo != '') {
    		if (!$Login->efetuarLogin_Prof($documento, $password, $tipo, 1, 0)) {
        		Uteis::alertJava("Login ou senha inválidos.", true);
				break;
	    }
	}
}
} elseif ($appN == 3) {
	$app = "Aluno Pré-cadastro";	
	
	if ($documento != '' && $password != '') {
	if (!$Login -> efetuarLogin_pre($documento, $password)) {		
		Uteis::alertJava("Login ou senha inválidos.", true);
	}
}
	
	
} else {
	$app = "RH";
	
	if ($documento != '' && $password != '') {
	if (!$Login -> efetuarLogin_RH($documento, $password, 1, 1)) {
		Uteis::alertJava("Login ou senha inválidos.", true);
	}
}
}
//echo $app;

if ($tipo == 1) {
	$_SESSION['tipo'] = 1;
	
} elseif ($tipo == 2) {
	$_SESSION['tipo'] = 2;
}

if  (($appN == 1) || ($appN == 3)) {
?>
<style>
	body{
		background-image: url("../images/bcgaluno2.jpg");
	}
</style>
<?php	
} elseif ($appN == 2) {
	$novoCadastro = "<p><input type=\"checkbox\" value=\"1\" name=\"graficos\" /> Não mostrar gráficos</p>";
	$Grafico = " <p><a href=\"recuperaSenhaFormProf.php\">Não sabe a sua senha?</a></p><p><a href=\"login.php?app=2&novo=1\"><button class=\"Bblue\">Não tem cadastro? Crie um agora</button></a></p>";
	
	
?>
<style>
	body{
		background-image: url("../images/bcgprof.jpg");
	}
</style>

<?php	
} else {
?>	
<style>
	body{
		background-image: url("../images/bcgrh.jpg");
	}
</style>
<?php	
}

//var_dump($_SESSION);

?>	
<link rel="shortcut icon" href="../upload/imagem/empresa/<?php echo $config[0]['favIcon'];?>">
</head>

<body>
<script src="<?php echo CAMINHO_CFG ?>js/login.js" language="javascript" type="text/javascript"></script>

<div class="header">
 			 <center> <img src="../upload/imagem/empresa/<?php echo $config[0]['logo'];?>" alt="logo" class="logo"/></center>
	</div>	

<div id="divs_jquery"></div>
<div id="alertas"></div>
	<div class="row">
		<div style="width:100%;    padding: 10px;">
			<div class="login-panel panel panel-default">
            			<div class="toplogin">Área do <?php echo $app?></div>
	
				<div class="panel-body">
        <form id="login" class="validate" action="login.php?app=<?php echo $appN?>" method="post" role="form">

            <p><div class="form-group">
            <?php if  ($appN != 4) { ?>
                <label>Documento:</label>
                <?php echo $TipoDocumentoUnico->selectTipoDocumentoUnicoSelect($teraDocumentoUnico, 1); ?>
                <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
            </div>
            </p>
            <p><div class="form-group">
                <label>Nº Documento:(digite apenas números e letras)</label>
                <input type="text" name="documentoUnico" id="documentoUnico" class="required form-control"
                       value="<?php echo $documento ?>" autocomplete="off" />
                <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
                </div>
                </p>
             <?php } else { ?>
                <label>CNPJ:</label>
        <input type="text" name="cnpj" id="cnpj" class="required form-control cnpj" value="<?php echo $login_temp?>"/>
         <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
  			<?php } ?>
                 
            <p>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="password" id="password"  value="<?php echo $senha_temp ?>"
                       autocomplete="off" class="required form-control"/>
                <span class="placeholder" style="display:none;color:red;" >Campo Obrigatório</span>
                <input type="checkbox" value="1" onclick="mostraSenha(this)"/>
                <small>mostrar a senha</small>
                </div>
            </p>
            
            <p>
            <div class="form-group">
<p>                <button class="Bblue">Efetuar Login</button></p>
</div>
			<?php  if ($appN == 1) {?>
            	<p><a href="recuperaSenhaForm.php">Não sabe a sua senha?</a></p>
            <?php }?>
        </form>
        	<?php echo $novoCadastro;?> 
        				</div>
 			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
<script type="text/javascript">
     function mensagem() {
                alert("Sua senha foi enviada para o e-mail cadastrado.");
            }

     $('#documentoUnico').focus();
     tipoDocumentoUnico("login");
     $('#tipoDocumentoUnico_idTipoDocumentoUnico').attr('onchange', 'tipoDocumentoUnico("login")')

<?php  if(isset($_GET['msg'])) { ?>
      alert('- Senha alterada com sucesso!');
<?php } ?>
ativarForm();
</script>
</body>
</html>