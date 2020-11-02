<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcao = new PlanoAcao();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
//$IntegranteGrupo = new IntegranteGrupo();

$caminhoInc = $_SERVER['DOCUMENT_ROOT'].CAMINHO_VENDAS."planoAcao/include/";

$idPlanoAcao = $_REQUEST['id'];
$apenasVer = $PlanoAcao->verificaStatusAprovacao($idPlanoAcao);

$valor = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao);

$idGrupo = $valor[0]['grupo_idGrupo'];

$idPlanoAcaoGrupo = $PlanoAcaoGrupo->getPAG_atual($idGrupo, 1);


?>

<div id="cadastro_PlanoAcao" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_cadastro_PlanoAcao" divExibir="div_cadastro_PlanoAcao" class="aba_interna ativa">Dados principais</div>
    <?php if($idPlanoAcao != "" && $idPlanoAcao > 0){ 
		//	if( !$apenasVer ){?>
				<div id="aba_cadastro_PlanoAcao" divExibir="div_Adicionais_PlanoAcao" class="aba_interna">Informações adicionais</div>
			<?php // } ?>
        <!--     <div id="aba_cadastro_PlanoAcao" divExibir="div_Abordagem_PlanoAcao" class="aba_interna">Complemento de Abordagem</div>  
			<div id="aba_disparo_PlanoAcao" divExibir="div_disparo_PlanoAcao" class="aba_interna" >Disparar plano de ação</div>-->
    <?php //  } ?>
  </div>
  <div id="modulos_PlanoAcao" class="conteudo_nivel">
    
    <div id="div_cadastro_PlanoAcao" class="div_aba_interna">
      <?php //if( !$apenasVer ) {
        
				require_once 'include/form/mudanca.php';?>
        
				<?php if($idPlanoAcao != "" && $idPlanoAcao > 0){ ?>
          
          <div id="div_lista_valorSimuladoPlanoAcao" class="linha-inteira">
            <?php require_once 'include/resourceHTML/valorHoraGrupo.php';?>
          </div>
          
          <div class="esquerda">
            <div id="div_lista_integrantePlanoAcao">
              <?php require_once 'include/resourceHTML/integranteGrupo.php';?>
            </div>
            <div id="div_lista_materialMontadoPlanoAcao">
              <?php require_once 'include/resourceHTML/materialMontadoPlanoAcao.php';?>
            </div>
          </div>
          
          <div class="direita">
           <div id="div_fechamentoGrupo"> 
        	<?php require_once "include/resourceHTML/planoAcaoGrupoNaoFaturar.php" ?>
        </div>    
          
          
            <div id="div_lista_medicaoResultado" >
              <?php require_once 'include/resourceHTML/medicaoResultado.php';?>
            </div>
            <div id="div_lista_MaterialDidaticPlanoAcao">
              <?php require_once 'include/resourceHTML/materialDidaticPlanoAcao.php';?>
            </div>
          </div>
        	
          <div style="clear:both;padding:1em;">
						<button class="button blue" onclick="mudarStatus(2);" >MUDAR ESTÁGIO</button>
     <!--       <button class="button gray" onclick="mudarStatus(3);">REPROVAR O PLANO</button>-->
					</div>
          
				<?php }          		  
			
			}else{
			
				$PlanoAcao->setIdPlanoAcao($idPlanoAcao);
				echo $PlanoAcao->ImprimePlanoAcao("1");
			
			}?>
    </div>
    
		<?php if($idPlanoAcao != "" && $idPlanoAcao > 0){ 
		
		//	if( !$apenasVer ){?>
      
        <div id="div_Adicionais_PlanoAcao" style="display:none" class="div_aba_interna">
          <div id="div_lista_registroDeAnotacoes">
            <?php require_once 'include/resourceHTML/registroDeAnotacoes.php';?>
          </div>
          <div id="div_lista_planoAcaoRegras">
            <?php require_once 'include/resourceHTML/planoAcaoRegras.php';?>
          </div>
        </div>
   <!--      <div id="div_Abordagem_PlanoAcao" style="display:none" class="div_aba_interna">
            <div id="div_lista_abordagem">
            <?php
              require_once 'include/form/planoAcaoComplemento.php';
            ?>
          </div> 
        </div>-->
			<?php // } ?>
      
   <!--   <div id="div_disparo_PlanoAcao" style="display:none" class="div_aba_interna">
        <?php //require_once $caminhoInc.'resourceHTML/disparoEmail.php';?>
      </div>-->
      
    <?php }?>
  </div>
</div>
<script>
function mudarStatus(idStatus){
	if(confirm('Deseja realmente mudar este grupo de estágio?')){
		postForm('form_PlanoAcao', '<?php echo CAMINHO_MODULO."relacionamento/mudanca/include/acao/aprovar.php"?>', '&idPlanoAcao=<?php echo $idPlanoAcao;?>&idStatus='+idStatus);
	}
}
</script>