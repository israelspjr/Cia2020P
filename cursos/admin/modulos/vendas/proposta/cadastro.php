<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Proposta = new Proposta();

$idProposta = $_GET['id'];
$apenasVer = $Proposta->verificaStatusAprovacao($idProposta);
?>


<div id="cadastro_Proposta" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  
  <div id="abas">
    <div id="aba_cadastro_Proposta" divExibir="div_cadastro_Proposta" class="aba_interna ativa">Dados básicos </div>
    <?php if($idProposta != "" && $idProposta > 0){ 
		if( !$apenasVer ){?>
    <div id="aba_contrato_Proposta" divExibir="div_Adicionais_Proposta" class="aba_interna" >Informações 
      adicionais</div>
    <?php } ?>
    <div id="aba_disparo_Proposta" divExibir="div_disparo_Proposta" class="aba_interna" >Disparar proposta</div>
    <?php } ?>
  </div>
  
  <div id="modulos_Proposta" class="conteudo_nivel">
   
    <div id="div_cadastro_Proposta" class="div_aba_interna">
      <?php if( !$apenasVer ){		
		
				require_once 'include/form/proposta.php';?>
        
        <?php if($idProposta != "" && $idProposta > 0){ ?>
        	<div class="esquerda">
                <div id="div_lista_intermediarioProposta" >
				  <?php require_once 'include/resourceHTML/intermediarioProposta.php';?>
                </div>
                <div id="div_lista_ValorSimuladoProposta" >
                  <?php require_once 'include/resourceHTML/valorSimuladoProposta.php';?>
                </div>
                
            </div>
            
            <div class="direita">                
                <div id="div_lista_integranteProposta" >
				  <?php require_once 'include/resourceHTML/integranteProposta.php';?>
                </div>
                
            </div>
            
    	<?php } 
		
		if($idProposta != "" && $idProposta > 0){ ?>
            <div style="clear:both;padding:1em;">
                <button class="button blue" onclick="mudarStatus(2);" >APROVAR</button>
                <button class="button gray" onclick="mudarStatus(3);">REPROVAR</button>
            </div>              
        <?php }
        
	  }else{
		  
		$Proposta->setIdProposta($idProposta);
        echo $Proposta->ImprimeProposta();
		
	  }?>
    </div>
    
	<?php if($idProposta != "" && $idProposta > 0){ 
	  
	  if( !$apenasVer ){?>
          <div id="div_Adicionais_Proposta" style="display:none" class="div_aba_interna">                      
              <div id="div_lista_registroDeAnotacoes" class="linha-inteira">
                <?php require_once 'include/resourceHTML/registroDeAnotacoes.php';?>
              </div>    
          </div>
      <?php } ?>
      
      <div id="div_disparo_Proposta" style="display:none" class="div_aba_interna">
        <?php require_once 'include/resourceHTML/disparoEmail.php';?>
      </div>
      
    <?php } ?>
  </div>
  $.post();
</div>
<script>
    function mudarStatus(idStatus){
        if(confirm('Deseja realmente mudar o status desta proposta? \n\nObservação: Após mudar o status ela não poderá mais ser edidata.')){
            postForm('', '<?php echo CAMINHO_VENDAS?>proposta/include/acao/aprovar.php', 'idProposta=<?php echo $idProposta?>&idStatus='+idStatus);        
        }
    }
    </script>