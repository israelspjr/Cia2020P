<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/padrao.php");
$Configuracoes = new Configuracoes();
 
 $Configuracoes->setIdConfig(1);
// $valorConfig = $Configuracoes->selectConfig("WHERE idConfig=1"); /
//$seguranca = $Configuracoes->getSeguranca();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/css.php"); ?>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/js.php"); ?>

<div id="cadastro_acervo" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_cadastro_acervo" divExibir="div_cadastro_acervo" class="aba_interna ativa">Configurações do Sistema</div>   
  </div>
  <div id="modulos_clientepf" class="conteudo_nivel">
    <div id="div_cadastro_acervo" class="div_aba_interna">
    <form id="form_acervo" class="validate" action="" method="post"  onsubmit="return false" >
     <input type="hidden" name="acao" value="cadastrar" />
     <input type="hidden" name="idConfig" value="1" /> 
     <div class="esquerda">
      <p>
        <label>Nome da Empresa</label>
        <input type="text" name="nomeEmpresa" id="nomeEmpresa" value="<?php echo $Configuracoes->getNomeEmpresa();?>" />
      </p>
      <p>
        <label>logo:</label>
        <input type="text" name="disponivel" id="disponivel" value="<?php echo $Configuracoes->getLogo();?>" />
      </p>
      <p>
        <label>Marca D'Agua:</label>
        <input type="text" name="disponivel" id="disponivel" value="<?php echo $Configuracoes->getLogo();?>" />
      </p>
      <p>
        <label>logo Favorito (.ico):</label>
        <input type="text" name="disponivel" id="disponivel" value="<?php echo $Configuracoes->getFavIcon();?>" />
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
        <label>Rodapé:</label>
        <input type="text" name="rodape" id="rodape" value="<?php echo $Configuracoes->getRodape();?>" />
      </p>
       <p>
        <label>Cabeçalho:</label>
        <input type="text" name="cabecalho" id="cabecalho" value="<?php echo $Configuracoes->getCabecalho();?>" />
      </p>
    </div>
    <div class="direita">
     <p>
        <label>Email (para dúvidas):</label>
        <input type="text" name="email" id="email" value="<?php echo $Configuracoes->getEmail();?>" />
      </p>
       <p>
        <label>Servidor SMTP:</label>
        <input type="text" name="email" id="email" value="<?php echo $Configuracoes->getSmtp();?>" />
      </p>
      <p>
        <label>Porta SMTP:</label>
        <input type="text" name="email" id="email" value="<?php echo $Configuracoes->getPorta();?>" />
      </p>
      <p>
        <label>Segurança:</label>
        <input type="radio" name="seguranca" id="seguranca" value="-" />Nenhuma &nbsp;&nbsp;&nbsp; <input type="radio" name="seguranca" id="seguranca" value="SSL" />SSL &nbsp;&nbsp;&nbsp; <input type="radio" name="seguranca" id="seguranca" value="TLS" /> TLS &nbsp;&nbsp;&nbsp; <input type="radio" name="seguranca" id="seguranca" value="STARTTLS" />STARTTLS
      </p>
      <p>
        <label>Email de envio(envio@...):</label>
        <input type="text" name="email" id="email" value="<?php echo $Configuracoes->getEmailEnvio();?>" />
      </p>
       <p>
        <label>Senha do email:</label>
        <input type="text" name="email" id="email" value="<?php echo $Configuracoes->getEmailSenha();?>" />
      </p>
    </div>
    <div class="linha-inteira">
     <button class="button blue" onclick="postForm('form_acervo', '<?php echo CAMINHO_CFG?>configuracoes/acao.php')">Salvar</button>
     </div>
    </form>
  </div>
</div>
<script>ativarForm();</script>   

