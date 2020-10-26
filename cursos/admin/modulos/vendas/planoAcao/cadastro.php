<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PlanoAcao = new PlanoAcao();

$idPlanoAcao = $_REQUEST['id'];
$apenasVer = $PlanoAcao -> verificaStatusAprovacao($idPlanoAcao);
?>

<div id="cadastro_PlanoAcao" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  
  <div id="abas">
    <div id="aba_cadastro_PlanoAcao" divExibir="div_cadastro_PlanoAcao" class="aba_interna ativa">Dados principais</div>    
    
		<?php if($idPlanoAcao != "" && $idPlanoAcao > 0){ 
      
			if( !$apenasVer ) {?>
        <div id="aba_cadastro_PlanoAcao" divExibir="div_Adicionais_PlanoAcao" class="aba_interna">Regras e Observações</div>
        <div id="aba_cadastro_PlanoAcao" divExibir="div_Abordagem_PlanoAcao" class="aba_interna">Complemento de Abordagem</div>        
      <?php } ?>
      
      <div id="aba_disparo_PlanoAcao" divExibir="div_disparo_PlanoAcao" class="aba_interna" >Disparar plano de ação</div>
      
    <?php } ?>
    
  </div>
  
  <div id="modulos_PlanoAcao" class="conteudo_nivel">
    <div id="div_cadastro_PlanoAcao" class="div_aba_interna">    
			
			<?php if( !$apenasVer ) {
          
        require_once 'include/form/planoAcao.php';?>
          
        <?php if( $idPlanoAcao != "" && $idPlanoAcao > 0){ ?>
                
          <div id="div_lista_valorSimuladoPlanoAcao" class="linha-inteira">          
            <?php
			require_once 'include/resourceHTML/valorSimuladoPlanoAcao.php';
		?>
          </div>   
               
          <div class="esquerda">
            <div id="div_lista_integrantePlanoAcao">
              <?php
				require_once 'include/resourceHTML/integrantePlanoAcao.php';
			?>
            </div>
            <div id="div_lista_materialMontadoPlanoAcao">
              <?php
				require_once 'include/resourceHTML/materialMontadoPlanoAcao.php';
			?>
            </div>
          </div>
          
          <div class="direita">
       <!--     <div id="div_lista_medicaoResultado" >
              <?php
				require_once 'include/resourceHTML/medicaoResultado.php';
			?>
            </div>-->
            <div id="div_lista_MaterialDidaticPlanoAcao">
              <?php
				require_once 'include/resourceHTML/materialDidaticPlanoAcao.php';
			?>
            </div>
          </div>

        <?php }

				if($idPlanoAcao != "" && $idPlanoAcao > 0){
					
					
 ?>
            
          <div style="clear:both;padding:1em;">
          <p>        Obs.: Não é necessário Aprovar/Reprovar Plano de Ação de Grupos ativos. Clique em salvar!     </p>
          <button class="button blue" onclick="postTemp();">Salvar</button>
           </p> 
       
        
            <button class="button blue" onclick="mudarStatus(2);" >APROVAR</button>
            <button class="button gray" onclick="mudarStatus(3);">REPROVAR</button>
          </div>
                  
        <?php }

					}else{
                    echo "Plano Professor:<img src=\"".CAMINHO_IMG."ver16.png\" 
                    onclick=\"window.open('".CAMINHO_PA."index.php?p=".Uteis::base64_url_encode($idPlanoAcao)."&a=".Uteis::base64_url_encode(2)."');\">";    
					$PlanoAcao->setIdPlanoAcao($idPlanoAcao);
					echo $PlanoAcao->ImprimePlanoAcao("1");

					}
				?>      	              

    </div>
    
    <?php if($idPlanoAcao != "" && $idPlanoAcao > 0){ 
		
			if( !$apenasVer ) {?>
        <div id="div_Adicionais_PlanoAcao" style="display:none" class="div_aba_interna">
          <div id="div_lista_contrato2">
            <?php
							require_once 'include/resourceHTML/contrato.php';
						?>
          </div>
          <div id="div_lista_registroDeAnotacoes">
            <?php
							require_once 'include/resourceHTML/registroDeAnotacoes.php';
						?>
          </div>
          <div id="div_lista_planoAcaoRegrasC">
          <?php
           require_once 'include/resourceHTML/regras.php';
          ?>
		  </div>
          <div id="div_lista_planoAcaoRegras">
            <?php
							require_once 'include/form/planoAcaoRegras.php';
						?>
          </div>
        </div>
        <div id="div_Abordagem_PlanoAcao" style="display:none" class="div_aba_interna">
            <div id="div_lista_abordagem">
            <?php
              require_once 'include/form/planoAcaoComplemento.php';
            ?>
          </div> 
       </div>
        
			<?php } ?>
        
      <div id="div_disparo_PlanoAcao" style="display:none" class="div_aba_interna">
      <div id="div_lista_disparo">
				<?php
					require_once 'include/resourceHTML/disparoEmail.php';
				?>
                </div>
      </div>
        
    <?php } ?>
    
   </div>
        </div>
</div>
<script>
function mudarStatus(idStatus){
	if(confirm('Deseja realmente mudar o status desta plano de ação? \n\nObservação: Após mudar o status ele não poderá mais ser edidato.')){
		postForm('', '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/aprovar.php', 'idPlanoAcao=<?php echo $idPlanoAcao?>&idStatus='+idStatus)		
	}
}
</script>