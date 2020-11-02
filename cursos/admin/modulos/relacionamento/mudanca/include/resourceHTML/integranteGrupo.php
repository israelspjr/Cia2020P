<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	$IntegranteGrupo = new IntegranteGrupo();
	
	$dataSaida = date("Y-m-d");
	
//	echo $dataSaida;
//	$idPlanoAcao = $_REQUEST['id'];
?>

<fieldset>
  <legend>Integrantes do grupo</legend>
  <div class="menu_interno"> <!--<img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/include/form/integrante.php";?>?idPlanoAcao=<?php echo $idPlanoAcao?>', '<?php echo CAMINHO_VENDAS."planoAcao/include/resourceHTML/integrantePlanoAcao.php?id=".$idPlanoAcao?>', '#div_lista_integrantePlanoAcao');" />--> </div>
  <div class="lista">
    <table id="tb_lista_IntegranteGrupo3" class="registros">
      <thead>
        <tr>
      
          <th>Nome</th>
          <th>Subvenção</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $IntegranteGrupo->selectIntegranteGrupoTr(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND dataSaida is null",1); ?>
		
<!--	//	or dataSaida < '".$dataSaida."') ",1);-->
      </tbody>
      <tfoot>
        <tr>
  
          <th>Nome</th>
 		<th>Subvenção</th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> 
tabelaDataTable('tb_lista_IntegranteGrupo3','simples');
</script> 
