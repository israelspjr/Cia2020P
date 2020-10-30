<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EncomendaMaterialGrupo.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/IntegranteGrupo.class.php");

$EncomendaMaterialGrupo = new EncomendaMaterialGrupo();
$IntegranteGrupo = new IntegranteGrupo();

$idPlanoAcaoGrupo = $_GET['id'];

?>

<fieldset>
  <legend>Encomendar material</legend>
  	<div class="lista">
	
    <?php 
	$data = date('Y-m-')."01";	
	$rs = $IntegranteGrupo->selectIntegranteGrupoFF($idPlanoAcaoGrupo, $data);
	
	if($rs){?>    
        <form id="form_EncomendaMaterialGrupo" class="validate" action="" method="post" onsubmit="return false" style="margin:0">        		
		<?php foreach($rs as $valor){	          
            $idIntegranteGrupo = $valor['idIntegranteGrupo'];		
            $nomeIntegrante = $IntegranteGrupo->getNomePF($idIntegranteGrupo);		
            ?>
            
            <div class="linha-inteira">
          
                <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="ABRIR/FECHAR LISTA DE GRUPOS" id="img_PlanoAcao_<?php echo $idIntegranteGrupo?>" 
                onclick="abrirFormulario('div_IntegrantePlanoAcao_<?php echo $idIntegranteGrupo?>', 'img_PlanoAcao_<?php echo $idIntegranteGrupo?>');" />
                
                <strong><?php echo $nomeIntegrante?></strong>
                
                <div class="agrupa" id="div_IntegrantePlanoAcao_<?php echo $idIntegranteGrupo?>" style="display:">
                
                    <table id="tbl_lista_EncomendaMaterialGrupo_<?php echo $idIntegranteGrupo?>" class="registros">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Preço</th>
                            <th>Parcelas</th>
                            <th>Primeira cobrança</th>
                            <th>Previsão de entrega</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php  		  			  
                             echo $EncomendaMaterialGrupo->listaMaterialEncomendar($idPlanoAcaoGrupo, $idIntegranteGrupo);
                            ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th></th>
                            <th>Preço</th>                        
                            <th>Parcelas</th>
                            <th>Primeira cobrança</th>
                            <th>Previsão de entrega</th>
                          </tr>
                        </tfoot>
                    </table>
                
                </div>      
                    
            </div>
          
            <script>tabelaDataTable('tbl_lista_EncomendaMaterialGrupo_<?php echo $idIntegranteGrupo?>', 'simples');</script>       
        <?php }?>
                      
        <p>
        <button onclick="postForm('form_EncomendaMaterialGrupo', '<?php echo CAMINHO_REL?>grupo/include/acao/encomendaMaterialGrupo.php?id=<?php echo $idPlanoAcaoGrupo?>');"
        class="button blue" >Salvar</button>
        </p>
      
		</form>
    <?php }?>
  </div>
</fieldset>
<script>
ativarForm();
function ativaOutrosCampos( obj ){
  var value = $(obj).attr('from');

  if( $(obj).attr('checked') == 'checked' ){
    $('#parcelas_'+value).attr('disabled', false).addClass('required');
    $('#dataPrimeiraCobranca_'+value).attr('disabled', false).addClass('required');
    $('#dataPrevisaoEntregaMaterial_'+value).attr('disabled', false);
	$('#valor_'+value).attr('disabled', false);
  }else{
    $('#parcelas_'+value).attr('disabled', true).removeClass('invalid required');
    $('#dataPrimeiraCobranca_'+value).attr('disabled', true).removeClass('invalid required');
    $('#dataPrevisaoEntregaMaterial_'+value).attr('disabled', true);
	$('#valor_'+value).attr('disabled', true);
  }
} 

</script> 
