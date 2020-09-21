<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$ClientePj = new ClientePj();
$TipoDocumentoUnico = new TipoDocumentoUnico();
$TipoCliente = new TipoCliente();
$ContatoAdicional = new ContatoAdicional();


$idClientePj = $_SESSION['idClientePj_SS'];

$valorClientePJ = $ClientePj->selectClientepj(" WHERE idClientePj = ".$idClientePj);

$nomeFantasia = $valorClientePJ[0]['nomeFantasia']; 
$cnpj = $valorClientePJ[0]['cnpj']; 
$inscricaoEstadual = $valorClientePJ[0]['inscricaoEstadual']; 
$logo = $valorClientePJ[0]['logo'];
$senhaAcesso = $valorClientePJ[0]['senhaAcesso']; 		

?>

<fieldset>
  <form id="formulario" method="post" enctype="multipart/form-data" action="<?php echo "modulos/cadastro/acao/clientePj.php"?>" style="display:none">
    <input type="hidden" id="acao" name="acao" value="foto" />
    <input type="file" id="add_foto" name="foto" />
  </form>
  <legend>Dados pessoais</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_clientePj', 'img_');" />
  <div class="agrupa" id="div_form_clientePj">
    <form id="form_clientePj" class="validate" action="" onsubmit="return false" method="post" >
      <div class="esquerda">
        <p>
          <label>Logomarca:</label>
          <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto').click();" /><strong><?php echo $logo != '' ? 'TROCAR': 'ADICIONAR';?></strong>
        <div id="visualizar">
          <?php if($logo != ''){?>
          <img src="<?php echo CAMINHO_UP?>imagem/foto/clientePj/miniatura-<?php echo $logo;?>" />
          <input type="hidden" name="foto_oculta" value="<?php echo $logo?>" required="required" />
          <?php }?>
        </div>
        </p>
        <p>
          <label>Nome fantasia:</label>
          <input type="text" name="nomeFantasia" id="nomeFantasia" value="<?php echo $nomeFantasia ?>" />
        </p>
        <p>
          <label>CNPJ:</label>
          <input type="text" name="cnpj" id="cnpj" class="required cnpj" value="<?php echo $cnpj ?>" />
           <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span></p>
      </div>
      <div class="direita">
        <p>
          <label for="isentoIE">Isento</label>
          <input type="checkbox" name="isentoIE" id="isentoIE" value="1" onclick="verificaIsento();" <?php echo $inscricaoEstadual == "ISENTO" ? "checked": "" ?> />
          <label>Inscricao estadual:</label>
          <input type="text" name="inscricaoEstadual" id="inscricaoEstadual" class="required" value="<?php echo $inscricaoEstadual ?>" <?php echo $inscricaoEstadual == "ISENTO" ? "disabled": "" ?>/>
        </p>
        <p>
          <label>Senha:</label>
          <img src="<?php echo CAMINHO_IMG."senha.png";?>" title="GERAR SENHA" onclick="geraSenha('password', 'rpassword');" />
          <input type="password" name="senhaAcesso" id="password" class="required password"  value="<?php echo $senhaAcesso ?>"/>
           <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span> </p>
        <p>
          <label>Confirma Senha:</label>
          <input type="password" name="senhaAcesso2" id="rpassword" class="required password" value="<?php echo $senhaAcesso ?>" />
           <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span> </p>
      </div>
      <p>
        <button class="bBlue" onclick="postForm('form_clientePj', '<?php echo "modulos/cadastro/clientePj.php?id=$idClientePj"?>')">Salvar</button>
      </p>
    </form>
  </div>
</fieldset>
<script>
   
/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_foto').on('change',function(){
	$('#visualizar').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#formulario').ajaxForm({
		target:'#visualizar' // o callback será no elemento com o id #visualizar
	}).submit();
});


function verificaIsento(){
	if( $('#isentoIE').attr('checked') ){	
		$('#inscricaoEstadual').val('ISENTO').attr('disabled', 'disabled');
	}else{
		$('#inscricaoEstadual').val('').removeAttr('disabled');
	}
}

</script> 