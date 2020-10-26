<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$EstadoCivil = new EstadoCivil();
$Pais = new Pais();
$ClientePf = new ClientePf();
$ClientePj = new ClientePj();
$TipoDocumentoUnico = new TipoDocumentoUnico();
$TipoCliente = new TipoCliente();
	
$idClientePf = $_GET['id'];
$proposta = $_GET['p'];	
?>

<div id="cadastro_clientepf" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_cadastro_clientepf" divExibir="div_cadastro_clientepf" class="aba_interna ativa">Dados Pessoais</div>
    <?php if($idClientePf != "" && $idClientePf > 0){ ?>
  <!--  <div id="aba_contrato_clientepf" divExibir="div_contrato_clientepf" class="aba_interna" >Contrato</div>-->
    <div id="aba_perfilaluno_clientepf" divExibir="div_perfilaluno_clientepf" class="aba_interna" >Perfil</div>
    <div id="aba_indicacoes_clientepf" divExibir="div_indicacoes_clientepf" class="aba_interna">Follow-up / Indicações</div>
    <div id="aba_preferenciadeprofessor_clientepf" divExibir="div_preferenciadeprofessor_clientepf" class="aba_interna">Preferencia de Professor</div>
    <div id="aba_financeiro" divExibir="div_financeiro" class="aba_interna">Financeiro</div>
    <div id="aba_historico" divExibir="div_historico" class="aba_interna">Histórico</div>
    <div id="aba_aviso" divExibir="div_aviso" class="aba_interna">Aviso</div>
    <?php } ?>
  </div>
  <div id="modulos_clientepf" class="conteudo_nivel">
    <div id="div_cadastro_clientepf" class="div_aba_interna">
      <?php require_once 'include/form/clientepf.php';
	  
	  if($idClientePf != "" && $idClientePf > 0){?>
      <div class="esquerda">
        <div id="div_lista_telefone">
          <?php require_once 'include/resourceHTML/telefone.php';?>
        </div>
        <div id="div_lista_endereco">
          <?php require_once 'include/resourceHTML/endereco.php';?>
        </div>
      </div>
      <div class="direita">
        <div id="div_lista_contatoAdicional">
          <?php require_once 'include/resourceHTML/contatoAdicional.php';?>
        </div>
        <div id="div_lista_enderecoVirtual">
          <?php require_once 'include/resourceHTML/enderecoVirtual.php';?>
        </div>
      </div>
      <?php //} ?>
    </div>
    <?php //if($idClientePf != "" && $idClientePf > 0){ ?>
  <!--  <div id="div_contrato_clientepf" style="display:none" class="div_aba_interna">
      <?php //require_once 'include/resourceHTML/contrato.php';?>
    </div>-->
    <div id="div_perfilaluno_clientepf" style="display:none" class="div_aba_interna">
      <div id="div_lista_opcaoAtividadeExtraClientePf">
        <?php require_once 'include/form/opcaoAtividadeExtraClientePf.php';?>
      </div>
      <div id="div_lista_formacaoPerfil" class="esquerda">
        <?php require_once 'include/resourceHTML/formacaoPerfil.php';?>
      </div>
      <div id="div_lista_idiomaBackgroundPerfil" class="direita">
        <?php require_once 'include/resourceHTML/idiomaBackgroundPerfil.php';?>
      </div>
    </div>
    <div id="div_indicacoes_clientepf" style="display:none" class="div_aba_interna">
     <div id="div_ocorrencia" class="linha-inteira">
      <?php require_once 'include/resourceHTML/ocorrencia.php';?>
      </div>
    </div>
      <div class="esquerda" id="div_indicacaoClientePf_ClientePf">
        <?php require_once 'include/resourceHTML/indicacaoClientePf_ClientePf.php';?>
      </div>
      <div class="direita" id="div_indicacaoClientePf_ClientePj">
        <?php require_once 'include/resourceHTML/indicacaoClientePf_ClientePj.php';?>
      </div>
    </div>
    <div id="div_preferenciadeprofessor_clientepf" style="display:none" class="div_aba_interna">
      <?php require_once 'include/form/opcaoAtividadeExtraProfessorClientePf.php';?>
    </div>
    <div id="div_financeiro" style="display:none" class="div_aba_financeiro">
      <?php require_once 'include/resourceHTML/financeiro.php';?>
    </div>
     <div id="div_aviso" style="display:none" class="div_aba_interna">
      <?php require_once 'include/resourceHTML/aviso.php';?>
    </div>
    <div id="div_historico" style="display:none" class="div_aba_interna">
    	<?php require_once 'include/resourceHTML/historico.php';?>
    </div>
   
    <?php } ?>
  </div>
</div>
<script>	
</script> 
