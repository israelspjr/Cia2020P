<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/padrao.php");
$Configuracoes = new Configuracoes();
 
 $Configuracoes->setIdConfig(1);
// $valorConfig = $Configuracoes->selectConfig("WHERE idConfig=1"); /
//echo  $Configuracoes->getSeguranca();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/css.php"); ?>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/js.php"); ?>

<div id="cadastro_acervo" class="">
 <!-- <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>-->
  <div id="abas">
    <div id="aba_cadastro_acervo" divExibir="div_cadastro_acervo" class="aba_interna ativa">Configurações do Sistema</div>   
  </div>
  <div id="modulos_clientepf" class="conteudo_nivel">
    <div id="div_cadastro_acervo" class="div_aba_interna">
    <!--LOGO -->
     <form id="formularioPf" method="post" enctype="multipart/form-data" action="<?php echo "/cursos/configuracoes/acao.php"?>" style="display:none;" >
      <input type="hidden" id="acao" name="acao" value="foto" />
      <input type="hidden" id="destino" name="destino" value="#visualizar" />
      <input type="file" id="add_foto" name="foto" onchange="postFileForm('formularioPf')" />
    </form>
    
      <!--Marca D'Agua -->
     <form id="formularioPf2" method="post" enctype="multipart/form-data" action="<?php echo "/cursos/configuracoes/acao.php"?>" style="display:none;" >
      <input type="hidden" id="acao" name="acao" value="marca" />
      <input type="hidden" id="destino" name="destino" value="#visualizar2" />
      <input type="file" id="add_foto2" name="foto" onchange="postFileForm('formularioPf2')" />
    </form>
    
      <!--LOGO  Favorito-->
     <form id="formularioPf3" method="post" enctype="multipart/form-data" action="<?php echo "/cursos/configuracoes/acao.php"?>" style="display:none;" >
      <input type="hidden" id="acao" name="acao" value="fav" />
      <input type="hidden" id="destino" name="destino" value="#visualizar3" />
      <input type="file" id="add_foto3" name="foto" onchange="postFileForm('formularioPf3')" />
    </form>
    
      <!--Rodapé -->
     <form id="formularioPf4" method="post" enctype="multipart/form-data" action="<?php echo "/cursos/configuracoes/acao.php"?>" style="display:none;" >
      <input type="hidden" id="acao" name="acao" value="rodape" />
      <input type="hidden" id="destino" name="destino" value="#visualizar4" />
      <input type="file" id="add_foto4" name="foto" onchange="postFileForm('formularioPf4')" />
    </form>
    
      <!-- Cabeçalho -->
     <form id="formularioPf5" method="post" enctype="multipart/form-data" action="<?php echo "/cursos/configuracoes/acao.php"?>" style="display:none;" >
      <input type="hidden" id="acao" name="acao" value="cabecalho" />
      <input type="hidden" id="destino" name="destino" value="#visualizar5" />
      <input type="file" id="add_foto5" name="foto" onchange="postFileForm('formularioPf5')" />
    </form>
    
    <form id="form_acervo" class="validate" action="" method="post"  onsubmit="return false" >
     <input type="hidden" name="acao" value="cadastrar" />
     <input type="hidden" name="idConfig" value="1" /> 
     <div class="esquerda">
      <p>
        <label>Nome da Empresa</label>
        <input type="text" name="nomeEmpresa" id="nomeEmpresa" value="<?php echo $Configuracoes->getNomeEmpresa();?>" />
      </p>
      <p>
        <label>Logo (formato retangular 200X100): </label>
          <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto').click();" title="Adicionar" />
          <input type="hidden" name="foto_oculta" value="<?php echo $Configuracoes->getLogo();?>" />
        <div id="visualizar">
          <?php if($Configuracoes->getLogo() != ''){?>
          <img src="<?php echo CAMINHO_UP?>imagem/empresa/<?php echo $Configuracoes->getLogo();?>" width="150px"/>
          <?php }?>
          </div>
          
      </p>
      <p>
        <label>Marca D'Agua (formato quadrado 400X400 com opacidade 0.3):</label>
          <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto2').click();" title="Adicionar" />
          <input type="hidden" name="marca_oculta" value="<?php echo $Configuracoes->getMarca();?>" />
        <div id="visualizar2">
          <?php if($Configuracoes->getMarca() != ''){?>
          <img src="<?php echo CAMINHO_UP?>imagem/empresa/<?php echo $Configuracoes->getMarca();?>" width="400px"/>
          <?php }?>
          </div>
          
      </p>
       <p>
        <label>logo Favorito (fundo transparente 40x40):</label>
          <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto3').click();" title="Adicionar" />
          <input type="hidden" name="fav_oculta" value="<?php echo $Configuracoes->getFavIcon();?>" />
        <div id="visualizar3">
          <?php if($Configuracoes->getFavIcon() != ''){?>
          <img src="<?php echo CAMINHO_UP?>imagem/empresa/<?php echo $Configuracoes->getFavIcon();?>" width="50px"/>
          <?php }?>
          </div>
          
      </p>
     
    
       <p>
        <label>Rodapé (formato retangular 600X200):</label>
          <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto4').click();" title="Adicionar" />
          <input type="hidden" name="rodape_oculta" value="<?php echo $Configuracoes->getRodape();?>" />
        <div id="visualizar4">
          <?php if($Configuracoes->getRodape() != ''){?>
          <img src="<?php echo CAMINHO_UP?>imagem/empresa/<?php echo $Configuracoes->getRodape();?>" width="400px"/>
          <?php }?>
          </div>
          
      </p>
      <p>
        <label>Cabeçalho (formato retangular 600X200):</label>
          <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto5').click();" title="Adicionar" />
          <input type="hidden" name="cabecalho_oculta" value="<?php echo $Configuracoes->getCabecalho();?>" />
        <div id="visualizar5">
          <?php if($Configuracoes->getCabecalho() != ''){?>
          <img src="<?php echo CAMINHO_UP?>imagem/empresa/<?php echo $Configuracoes->getCabecalho();?>" width="400px"/>
          <?php }?>
          </div>
          
      </p>
   
    </div>
    <div class="direita">
     <p>
        <label>Email (para dúvidas):</label>
       <input type="text" name="email" id="email" value="<?php echo $Configuracoes->getEmail();?>" />
      </p>
        <p>
        <label>WhatsApp:</label>
        <input type="text" name="zap" id="zap" value="<?php echo $Configuracoes->getWhatsApp();?>" />
      </p>
      <p>
        <label>Site:</label>
        <input type="text" name="site" id="site" value="<?php echo $Configuracoes->getSite();?>" />
      </p>
       <p>
        <label>Servidor SMTP:</label>
        <input type="text" name="smtp" id="smtp" value="<?php echo $Configuracoes->getSmtp();?>" />
      </p>
      <p>
        <label>Porta SMTP:</label>
        <input type="text" name="portaSmtp" id="portaSmtp" value="<?php echo $Configuracoes->getPorta();?>" />
      </p>
      <p>
        <label>Segurança:</label>
        <input type="radio" name="seguranca" id="seguranca" value="-" <?php if ($Configuracoes->getSeguranca() == '') { echo "checked";}?>/>Nenhuma &nbsp;&nbsp;&nbsp; 
        <input type="radio" name="seguranca" id="seguranca" value="SSL" <?php if ($Configuracoes->getSeguranca() == 'SSL') { echo "checked";}?>/>SSL &nbsp;&nbsp;&nbsp; 
        <input type="radio" name="seguranca" id="seguranca" value="TLS" <?php if ($Configuracoes->getSeguranca() == 'TLS') { echo "checked";}?> /> TLS &nbsp;&nbsp;&nbsp; 
        <input type="radio" name="seguranca" id="seguranca" value="STARTTLS" <?php if ($Configuracoes->getSeguranca() == 'STARTTLS') { echo "checked";}?> />STARTTLS
      </p>
      <p>
        <label>Email de envio de comunicações do sistema(envio@...):</label>
        <input type="text" name="emailEnvio" id="emailEnvio" value="<?php echo $Configuracoes->getEmailEnvio();?>" />
      </p>
       <p>
        <label>Senha do email:</label>
        <input type="text" name="emailSenha" id="emailSenha" value="<?php echo $Configuracoes->getSenhaEmail();?>" />
      </p>
   </div>
    <div class="linha-inteira">
     <button class="button blue" onclick="postForm('form_acervo', '/cursos/configuracoes/acao.php','','resposta')">Salvar</button>
     <div id="resposta"></div>
     </div>
    </form>
  </div>
</div>
<script>

ativarForm();

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file').on('change', function(){
	$('#visualizarFile').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile').ajaxForm({
		target:'#visualizarFile' // o callback será no elemento com o id #visualizar
	}).submit();
});

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file2').on('change', function(){
	$('#visualizarFile2').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile2').ajaxForm({
		target:'#visualizarFile2' // o callback será no elemento com o id #visualizar
	}).submit();
});

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file3').on('change', function(){
	$('#visualizarFile3').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile3').ajaxForm({
		target:'#visualizarFile3' // o callback será no elemento com o id #visualizar
	}).submit();
});

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file4').on('change', function(){
	$('#visualizarFile4').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile4').ajaxForm({
		target:'#visualizarFile4' // o callback será no elemento com o id #visualizar
	}).submit();
});

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file5').on('change', function(){
	$('#visualizarFile5').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile5').ajaxForm({
		target:'#visualizarFile5' // o callback será no elemento com o id #visualizar
	}).submit();
});

</script>   

