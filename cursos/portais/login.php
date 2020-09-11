<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");
echo CAMINHO_CFG;
//require_once($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/js_area.php");
//require_once($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/css_area.php");

echo "teste";

?>	
</head>

<body>
<script src="<?php echo CAMINHO_CFG ?>js/login.js" language="javascript" type="text/javascript"></script>

<p>&nbsp;</p>

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
                <?php //echo $TipoDocumentoUnico->selectTipoDocumentoUnicoSelect($teraDocumentoUnico, 1); ?>
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
            <p><a href="recuperaSenhaForm.php">Não sabe a sua senha?</a></p>
        </form>
        	<?php echo $novoCadastro;?> 
        				</div>
 			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
<script type="text/javascript">
/*     function mensagem() {
                alert("Sua senha foi enviada para o e-mail cadastrado.");
            }

     $('#documentoUnico').focus();
     tipoDocumentoUnico("login");
     $('#tipoDocumentoUnico_idTipoDocumentoUnico').attr('onchange', 'tipoDocumentoUnico("login")')

<?php //if(isset($_GET['msg'])) { ?>
      alert('- Senha alterada com sucesso!');
<?php //} */?>
//ativarForm();
</script>
</body>
</html>