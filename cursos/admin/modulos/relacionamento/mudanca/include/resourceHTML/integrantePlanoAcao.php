<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	$IntegrantePlanoAcao = new IntegrantePlanoAcao();
	
	$idPlanoAcao = $_REQUEST['id'];
?>

<fieldset>
  <legend>Integrantes do plano de ação</legend>
  <div class="menu_interno"> <!--<img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/include/form/integrante.php";?>?idPlanoAcao=<?php echo $idPlanoAcao?>', '<?php echo CAMINHO_VENDAS."planoAcao/include/resourceHTML/integrantePlanoAcao.php?id=".$idPlanoAcao?>', '#div_lista_integrantePlanoAcao');" />--> </div>
  <div class="lista">
    <table id="tb_lista_IntegrantePlanoAcao" class="registros">
      <thead>
        <tr>
          <th></th>
          <th>Nome</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $IntegrantePlanoAcao->selectIntegrantePlanoAcaoTr(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao,1);?>
      </tbody>
      <tfoot>
        <tr>
          <th></th>
          <th>Nome</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_IntegrantePlanoAcao', 'simples');</script> 
