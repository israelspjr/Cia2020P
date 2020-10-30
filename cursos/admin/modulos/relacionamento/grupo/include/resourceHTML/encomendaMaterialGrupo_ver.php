<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EncomendaMaterialGrupo.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/IntegranteGrupo.class.php");

$EncomendaMaterialGrupo = new EncomendaMaterialGrupo();
$IntegranteGrupo = new IntegranteGrupo();

$idPlanoAcaoGrupo = $_GET['id'];

?>

<fieldset>
  <legend>Materiais encomendados</legend>
  	<div class="lista">
	
    <?php 
	$data = date('Y-m-')."01";	
	$rs = $IntegranteGrupo->selectIntegranteGrupoFF($idPlanoAcaoGrupo, $data);
	
	foreach($rs as $valor){	          
        $idIntegranteGrupo = $valor['idIntegranteGrupo'];		
        $nomeIntegrante = $IntegranteGrupo->getNomePF($idIntegranteGrupo);		
        ?>
        
        <div class="linha-inteira">
      
            <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="ABRIR/FECHAR LISTA DE GRUPOS" id="img_enc_<?php echo $idIntegranteGrupo?>" 
            onclick="abrirFormulario('div_enc_<?php echo $idIntegranteGrupo?>', 'img_enc_<?php echo $idIntegranteGrupo?>');" />
            
            <strong><?php echo $nomeIntegrante?></strong>
            
            <div class="agrupa" id="div_enc_<?php echo $idIntegranteGrupo?>" >
            
                <table id="tbl_lista_enc_<?php echo $idIntegranteGrupo?>" class="registros">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Parcelas</th>
                        <th>Parcelas pagas</th>
                        <th>Primeira cobrança</th>
                        <th>Previsão de entrega</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php  		  			  
					$where = " WHERE integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo ";
					echo $EncomendaMaterialGrupo->selectEncomendaMaterialGrupoTr($where);
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Parcelas</th>
                        <th>Parcelas pagas</th>
                        <th>Primeira cobrança</th>
                        <th>Previsão de entrega</th>
                      </tr>
                    </tfoot>
                </table>
            
            </div>      
                
        </div>
      
        <script>tabelaDataTable('tbl_lista_enc_<?php echo $idIntegranteGrupo?>', 'simples');</script>       
    <?php }?>
        
  </div>
</fieldset>
