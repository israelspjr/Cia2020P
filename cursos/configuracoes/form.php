<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/padrao.php");
$Configuracoes = new Configuracoes();

 $valorConfig = $Configuracoes->selectConfig("WHERE idConfig=1"); 

?>

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
      <p>
        <label>Nome da Empresa</label>
        <input type="text" name="nomeEmpresa" id="nomeEmpresa" value="<?php echo $valorConfig->getNomeEmpresa();?>" />
      </p>
      <p>
        <label>logo:</label>
        <input type="number" name="disponivel" id="disponivel" value="<?php echo $disponivel;?>" />
      </p>
      <p>
        <label>logo Favorito  (.ico):</label>
        <input type="number" name="disponivel" id="disponivel" value="<?php echo $disponivel;?>" />
      </p>
      <p>
        <label>WhatsApp:</label>
        <input type="text" name="zap" id="zap" value="<?php echo $valorConfig->getWhatsApp();?>" />
      </p>
       <p>
        <label>Email:</label>
        <input type="text" name="email" id="email" value="<?php echo $valorConfig->getEmail();?>" />
      </p>
      <p>
        <label>Site:</label>
        <input type="text" name="site" id="site" value="<?php echo $valorConfig->getSite();?>" />
      </p>
       <p>
        <label>Rodapé:</label>
        <input type="text" name="rodape" id="rodape" value="<?php echo $valorConfig->getRodape();?>" />
      </p>
       <p>
        <label>Cabeçalho:</label>
        <input type="text" name="cabecalho" id="cabecalho" value="<?php echo $valorConfig->getCabecalho();?>" />
      </p>
    
     <button class="button blue" onclick="postForm('form_acervo', '<?php echo CAMINHO_CF?>configuracoes/acao.php')">Salvar</button>
    </form>
  </div>
</div>
<script>ativarForm();</script>   

