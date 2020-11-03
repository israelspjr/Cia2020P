<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idPlanoAcaoGrupo = $_GET['id'];
error_reporting(E_ALL);
?>

<div id="cadastro_Grupo" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_div_principais" divExibir="div_principais" class="aba_interna ativa">Dados principais</div>
    <div id="aba_div_aulas" divExibir="div_aulas" class="aba_interna">Frequência</div>
    <div id="aba_div_financeiro_grupo" divExibir="div_financeiro_grupo" class="aba_interna ">Financeiro</div>
    <div id="aba_div_acompanhamento_grupo" divExibir="div_acompanhamentoGeral" class="aba_interna" > Pedagógico</div>
    <div id="aba_div_outros_grupo" divExibir="div_outros_grupo" class="aba_interna ">Outros</div>
  </div>
  <div id="modulos_Grupo" class="conteudo_nivel">
 
    <div id="mudar_nivel"><?php require_once "include/resourceHTML/mudarNivel.php" ?></div>  
  	   
    <div id="div_principais" class="div_aba_interna">     
  
      
    
      <div id="div_cadastro_Grupo">
        <?php require_once 'include/form/planoAcaoGrupo.php';?>
      </div>
      <div id="div_integranteGrupo">
        <?php require_once "include/resourceHTML/integranteGrupo.php" ?>
      </div>
      <div id="diasDeAula_planoAcaoGrupo">
        <?php require_once "include/resourceHTML/diasDeAula_planoAcaoGrupo.php" ?>
      </div>
      <div id="buscaRelacimento">
      <?php require_once "include/resourceHTML/busca.php" ?>
      </div>
    </div>
    
    <div id="div_aulas" class="div_aba_interna" style="display:none;">
      <?php require_once "include/resourceHTML/ff_banco.php" ?>
    </div>
    
    <div id="div_financeiro_grupo" class="div_aba_interna" style="display:none;">
      
            
      <div class="esquerda">
        <div id="div_valorHoraGrupo" >
          <?php require_once "include/resourceHTML/valorHoraGrupo.php" ?>
        </div>
        <div id="div_produtoAdicionalPlanoAcaoGrupo">
          <?php require_once "include/resourceHTML/produtoAdicionalPlanoAcaoGrupo.php" ?>
        </div>
         <div id="div_planoAcaoGrupoAjudaCusto">
          <?php require_once "include/resourceHTML/planoAcaoGrupoAjudaCusto.php" ?>
        </div>
          
      </div>
      
      <div class="direita">
        <div id="div_creditoDebitoGrupo" >
          <?php require_once "include/resourceHTML/creditoDebitoGrupo.php" ?>
        </div>
        <div id="div_fechamentoGrupo"> 
        	<?php require_once "include/resourceHTML/planoAcaoGrupoNaoFaturar.php" ?>
        </div>
        <div id="div_downsell" class="linha-inteira"> 
		<?php require_once "include/resourceHTML/downsell.php" ?>
      </div>
        </div>
        <div id="div_todasSubvencao" class="linha-inteira">
        	<?php require_once "include/resourceHTML/subvencaoGrupo.php" ?>
        </div>
      
      <div id="div_anotacoes_financeiro" class="linha-inteira">
        <?php require_once "include/resourceHTML/anotacoesFinanceiro.php"?>
      </div>
      <div id="div_planoAcaoGrupoAjudaCusto" class="linha-inteira"> 
		<?php require_once "include/resourceHTML/planoAcaoGrupoAjudaCusto.php" ?>
      </div>
     
           
    </div>
    
    <div id="div_acompanhamentoGeral" class="div_aba_interna" style="display:none;">
    
   
      <div id="div_provas_grupo">
        <?php require_once "include/resourceHTML/provas.php" ?>
      </div>
    
   <!--  <div id="div_Abordagem_PlanoAcao" style="display:none" class="div_aba_interna">-->
            <div id="div_lista_abordagem">
            <?php
              require_once 'include/form/planoAcaoComplemento.php';
            ?>
          </div> 
          </div>
<!--        </div>-->
    
    <div id="div_outros_grupo" class="div_aba_interna" style="display:none;">
    
     
      <div id="ini_mudanca">
        <?php require_once "include/resourceHTML/iniciarMudanca.php" ?>
      </div>
      <div id="div_contrato">
        <?php require_once "include/resourceHTML/contrato.php" ?>
      </div>
      <div id="div_anotacoes">
        <?php require_once "include/resourceHTML/anotacoes.php" ?>
      </div>
 <!--     <div id="div_fechamentoGrupo">
        <?php //require_once "include/resourceHTML/fechamentoGrupo.php" ?>
      </div>-->
  
    </div>

<script>
//Contains the last jqXHR object.

var currentRequest;

	function ajaxBanco(x) {
	 var grupo = x;
//  grupo = x;
  currentRequest = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/include/acao/ajaxBanco.php"?>",
    type:"POST",
 //   datatype: "html",
	async:true,
//    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{grupo:grupo}//,
//	timeout: 10000   
  });
}
	
	ajaxBanco(<?php echo $idPlanoAcaoGrupo?>);
	
	
	
	</script>
    
  </div>
</div>
