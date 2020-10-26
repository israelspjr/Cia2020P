<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
	$idIntegrantePlanoAcao = $_GET['id'];
	$planoAcao_idPlanoAcao = $_GET['idPlanoAcao'];
?>
<div id="abas">
  <div id="aba_cadastro_integrantePlanoAcao" divExibir="div_cadastro_integrantePlanoAcao" class="aba_interna ativa">Dados principais</div>
  <?php if($idIntegrantePlanoAcao != "" && $idIntegrantePlanoAcao > 0){ ?>
  <div id="aba_cadastro_subvencao" divExibir="div_subvencao" class="aba_interna">Coparticipação</div>
  <div id="aba_cadastro_vpg" divExibir="div_vpgPlanoAcao" class="aba_interna">VPG</div>
  <div id="aba_qualidadeComunicacao_PlanoAcao" divExibir="div_qualidadeComunicacao_PlanoAcao" class="aba_interna" >Qualidade Comunicação</div>
  <?php } ?>
</div>
<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
<div id="cadastro_subvencao" class="conteudo_nivel">
  <div id="div_cadastro_integrantePlanoAcao" class="div_aba_interna">
    <?php require_once 'integrantePlanoAcao.php';?>
  </div>
  <?php if($idIntegrantePlanoAcao != "" && $idIntegrantePlanoAcao > 0){ ?>
  <div id="div_subvencao" style="display:none" class="div_aba_interna">
    <div id="div_subvencaoCursoPlanoAcao" class="esquerda">
      <?php require_once 'subvencaoCursoPlanoAcao.php';?>
    </div>
    <div id="div_subvencaoMaterialPlanoAcao" class="direita">
      <?php require_once 'subvencaoMaterialPlanoAcao.php';?>
    </div>
  </div>
  <div id="div_vpgPlanoAcao" style="display:none" class="div_aba_interna" >
    <?php require_once 'vpgPlanoAcao.php';?>
  </div>
  <div id="div_qualidadeComunicacao_PlanoAcao" style="display:none" class="div_aba_interna">
      <?php require_once 'qualidadeComunicacaoPlanoAcao.php';?>
  </div>
  <?php } ?>
</div>
<script>ativarForm();</script>