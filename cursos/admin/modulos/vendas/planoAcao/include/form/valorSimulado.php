<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idValorSimuladoPlanoAcao = $_GET['id'];
$planoAcaoIdPlanoAcao = $_GET['idPlanoAcao'];
		
?>


<div id="abas">
  <div id="aba_valorSimuladoPlanoAcao" divExibir="div_valorSimuladoPlanoAcao" class="aba_interna ativa">Valores</div>
  <?php if($idValorSimuladoPlanoAcao != "" && $idValorSimuladoPlanoAcao > 0){ ?>
  <div id="aba_div_produtoAdicional" divExibir="div_lista_ProdutoAdicional" class="aba_interna">Produtos adicionais</div>
  <div id="aba_opcaoDiaPlanoAcao" divExibir="div_lista_OpcaoDiaPlanoAcao" class="aba_interna">Simulação de dias e horários</div>  
  <?php } ?>
</div>
<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
<div class="conteudo_nivel">
  <div id="div_valorSimuladoPlanoAcao" class="div_aba_interna">
  	<?php require_once "valorSimuladoPlanoAcao.php"?>    
  </div>
  <?php if($idValorSimuladoPlanoAcao != "" && $idValorSimuladoPlanoAcao > 0){ ?>
  <div id="div_lista_ProdutoAdicional" class="div_aba_interna" style="display:none;">
  		<?php require_once "../resourceHTML/produtoAdicional.php"?>
  </div>
  <div id="div_lista_OpcaoDiaPlanoAcao" class="div_aba_interna" style="display:none;">
  		<?php require_once "../resourceHTML/opcaoDiaPlanoAcao.php"?>
  </div>
  <?php } ?>
</div>